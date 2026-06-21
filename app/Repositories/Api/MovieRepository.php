<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repositories\Api\ApiRepositoryInterface;

class MovieRepository implements ApiRepositoryInterface
{
  public function allNames(): array
  {
    return DB::table('searchable')
    ->where('type', 'movie')
    ->orderBy('name', 'asc')
    ->pluck('name')
    ->toArray();
  }
  
  public function random(): array
  {
    $random = DB::table('searchable')
    ->where('type', 'movie')
    ->inRandomOrder()
    ->get('external_id')
    ->first();
    
    return $this->get($random->external_id);
  }
  
  public function get(string $id): array
  {
    $response = Http::withToken(config('services.apiKeys.movie'))
    ->timeout(10)
    ->get("https://api.themoviedb.org/3/movie/{$id}",
    [
      'language' => 'en-US',
      'append_to_response' => 'credits,translations,videos,watch/providers'
    ]);
    
    if ($response->successful())
    {
      $movie = $response->json();
      
      $video = collect($movie['videos']['results'])
      ->where('type', 'Trailer')
      ->where('site', 'YouTube')
      ->map(fn($video) => "https://www.youtube.com/watch?v={$video['key']}")
      ->first();
      
      return
      [
        'name'          => $movie['title'],
        'tagline'       => $movie['tagline'],
        'overview'      => $movie['overview'],
        
        'collection'    => $movie['belongs_to_collection']['name'] ?? null,
        'status'        => $movie['status'],
        'genres'        => collect($movie['genres'])->pluck('name')->all(),
        
        'popularity'    => $movie['popularity'],
        'vote_average'  => $movie['vote_average'],
        'vote_count'    => $movie['vote_count'],
        
        'countries'     => collect($movie['production_countries'])->pluck('name')->all(),
        'budget'        => $movie['budget'],
        'revenue'       => $movie['revenue'],
        'runtime'       => $movie['runtime'],
        'release_date'  => $movie['release_date'],
        
        'cast'          => collect($movie['credits']['cast'])->pluck('name', 'character')->all(),
        'translations'  => collect($movie['translations']['translations'])->pluck('english_name')->all(),
        'buy'           => $this->formatLogos($movie['watch/providers']['results']['DE']['buy'] ?? [], 'provider_name'),
        'rent'          => $this->formatLogos($movie['watch/providers']['results']['DE']['rent'] ?? [], 'provider_name'),
        
        'poster'        => "https://image.tmdb.org/t/p/w1280/{$movie['poster_path']}",
        'backdrop'      => "https://image.tmdb.org/t/p/w1280/{$movie['backdrop_path']}",
        'video'         => $video,
      ];
    }
  }
  
  private function formatLogos(?array $items, string $keyName, string $size = 'w300'): array
  {
    if (empty($items))
      return [];
    
    return collect($items)->mapWithKeys(fn($item) =>
    [
      $item[$keyName] => $item['logo_path'] ? "https://image.tmdb.org/t/p/{$size}{$item['logo_path']}" : null
    ])->all();
  }
  
  public function getDailyWordle(): ?array
  {
    $daily = DB::table('daily_wordle')
    ->where('type', 'movie')
    ->latest('date')
    ->first();
    
    return $daily ? json_decode($daily->data, true) : null;
  }
  
  public function findByName($name): ?array
  {
    $result = DB::table('searchable')
    ->where('type', 'movie')
    ->where('name', $name)
    ->get('external_id')
    ->first();
    
    if (!$result)
      return null;
    
    return $this->get($result->external_id);
  }
}