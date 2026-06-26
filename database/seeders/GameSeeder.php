<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GameSeeder extends Seeder
{
  public function run(): void
  { 
    try
    {
      $insert = [];
      $maxPages = 1;
      
      for ($i = 1; $i <= $maxPages; $i++)
      { 
        $response = Http::timeout(10)
        ->get('https://api.rawg.io/api/games',
        [
          'key' => config('services.apiKeys.game'),
          'page' => $i,
          'page_size' => 40,
          'metacritic' => '80,100',
        ])
        ->throw();
        
        if ($response->successful())
        {
          $json = $response->json();
          
          if ($i == 1)
            $maxPages = ceil($json['count'] / 40);
          
          $games = collect($json['results'])
          ->map(function ($game)
          {
            $id = $game['id'] ?? null;
            $name = $game['name'] ?? null;
            
            if (!$name || !$id)
              return null;
            
            return
            [
              'name'        => $name,
              'type'        => 'game',
              'external_id' => $id,
              'created_at'  => now(),
              'updated_at'  => now(),
            ];
          })
          ->filter()
          ->all();
          
          $insert = array_merge($insert, $games);
        }
      }
      
      if (!empty($insert))
      {
        DB::table('searchable')->upsert(
          $insert, 
          ['type', 'external_id'],          
          ['name', 'updated_at']       
        );
      }
    }
    catch (\Exception $e)
    {
      Log::error("RAWG API Fehler: {$e->getMessage()}");
    }
  }
}