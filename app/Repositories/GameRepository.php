<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class GameRepository
{
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
}