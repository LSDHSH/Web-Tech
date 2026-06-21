<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repositories\Api\ApiRepositoryInterface;

class GameRepository implements ApiRepositoryInterface
{
  public function allNames(): array
  {
    return DB::table('searchable')
    ->where('type', 'game')
    ->orderBy('name', 'asc')
    ->pluck('name')
    ->toArray();
  }
  
  public function random(): array
  {
    $random = DB::table('searchable')
    ->where('type', 'game')
    ->inRandomOrder()
    ->get('external_id')
    ->first();
    
    return $this->get($random->external_id);
  }
  
  public function get(string $id): array
  {
    $response = Http::timeout(10)
    ->get("https://api.rawg.io/api/games/{$id}",
    [
      'key' => config('services.apiKeys.game'),
    ]);
    
    if ($response->successful())
    {
      $game = $response->json();
      
      return
      [
        'name'          => $game['name'],
        'description'   => $game['description_raw'],
        
        'series'        => ($game['game_series_count'] ?? 0) > 0,
        'tba'           => $game['tba'],
        'genres'        => collect($game['genres'])->pluck('name')->all(),
        
        'metacritic'    => $game['metacritic'],
        'esrb'          => $game['esrb_rating']['name'] ?? 'Not Rated',
        'achievements'  => $game['achievements_count'],
        'released'      => $game['released'],
        
        'platforms'     => collect($game['platforms'])->pluck('platform.name')->all(),
        'stores'        => collect($game['stores'])->pluck('store.name')->all(),
        
        'developers'    => collect($game['developers'])->pluck('name')->all(),
        'publishers'    => collect($game['publishers'])->pluck('name')->all(),
        
        'background'    => $game['background_image'],
      ];
    }
  }
  
  public function getDailyWordle(): ?array
  {
    $daily = DB::table('daily_wordle')
    ->where('type', 'game')
    ->latest('date')
    ->first();
    
    return $daily ? json_decode($daily->data, true) : null;
  }
  
  public function findByName($name): ?array
  {
    $result = DB::table('searchable')
    ->where('type', 'game')
    ->where('name', $name)
    ->get('external_id')
    ->first();
    
    if (!$result)
      return null;
    
    return $this->get($result->external_id);
  }
}