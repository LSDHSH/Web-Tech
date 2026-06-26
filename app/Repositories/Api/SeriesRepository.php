<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repositories\Api\ApiRepositoryInterface;

class SeriesRepository implements ApiRepositoryInterface
{
  public function allNames(): array
  {
    return DB::table('searchable')
    ->where('type', 'series')
    ->orderBy('name', 'asc')
    ->pluck('name')
    ->toArray();
  }
  
  public function random(): array
  {
    $random = DB::table('searchable')
    ->where('type', 'series')
    ->inRandomOrder()
    ->get('external_id')
    ->first();

    if (!$random)
      return [];
    
    return $this->get($random->external_id);
  }
  
  public function get(string $id): array
  {
    $response = Http::withToken(config('services.apiKeys.series'))
    ->timeout(10)
    ->get("https://api.themoviedb.org/3/tv/{$id}",
    [
      'language' => 'en-US',
      'append_to_response' => 'credits,translations,videos,watch/providers'
    ]);
    
    if ($response->successful())
    {
      $series = $response->json();
      
      $video = collect($series['videos']['results'])
      ->where('type', 'Trailer')
      ->where('site', 'YouTube')
      ->map(fn($video) => "https://www.youtube.com/watch?v={$video['key']}")
      ->first();
      
      return
      [
        'name'                => $series['name'],
        'tagline'             => $series['tagline'],
        'overview'            => $series['overview'],
        
        'status'              => $series['status'],
        'in_production'       => $series['in_production'],
        'genres'              => collect($series['genres'])->pluck('name')->all(),
        
        'popularity'          => $series['popularity'],
        'vote_average'        => $series['vote_average'],
        'vote_count'          => $series['vote_count'],
        
        'countries'           => collect($series['production_countries'])->pluck('name')->all(),
        'number_of_seasons'   => $series['number_of_seasons'],
        'number_of_episodes'  => $series['number_of_episodes'],
        'episode_runtime'     => collect($series['episode_run_time'])->avg(),
        'first_air_date'      => $series['first_air_date'],
        'last_air_date'       => $series['last_air_date'],
        
        'cast'                => $cast = collect($series['credits']['cast'])->pluck('name', 'character')->all(),
        'translations'        => collect($series['translations']['translations'])->pluck('english_name')->all(),
        'buy'                 => $this->formatLogos($series['watch/providers']['results']['DE']['buy'] ?? [], 'provider_name'),
        'flatrate'            => $this->formatLogos($series['watch/providers']['results']['DE']['flatrate'] ?? [], 'provider_name'),
        
        'poster'              => "https://image.tmdb.org/t/p/w1280/{$series['poster_path']}",
        'backdrop'            => "https://image.tmdb.org/t/p/w1280/{$series['backdrop_path']}",
        'video'               => $video,  
      ];
    }
    return [];
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
    ->where('type', 'series')
    ->latest('date')
    ->first();
    
    return $daily ? json_decode($daily->data, true) : null;
  }
  
  public function findByName($name): ?array
  {
    $result = DB::table('searchable')
    ->where('type', 'series')
    ->where('name', $name)
    ->get('external_id')
    ->first();
    
    if (!$result)
      return null;
    
    $series = $this->get($result->external_id);
    return empty($series) ? null : $series;
  }
}