<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeriesSeeder extends Seeder
{
  public function run(): void
  { 
    try
    {
      $insert = [];
      $maxPages = 1;
      
      for ($i = 1; $i <= $maxPages; $i++)
      { 
        $response = Http::withToken(config('services.apiKeys.series'))
        ->timeout(5)
        ->get('https://api.themoviedb.org/3/discover/tv',
        [
          'language' => 'en-US',
          'page' => $i,
          'vote_average.gte' => 8.0,
          'vote_count.gte' => 500
        ])
        ->throw();
        
        if ($response->successful())
        {
          $json = $response->json();
          $maxPages = $json['total_pages'];
          
          $series = collect($json['results'])
          ->map(function ($s)
          {
            $id = $s['id'] ?? null;
            $name = $s['name'] ?? null;
            
            if (!$name || !$id)
              return null;
            
            return
            [
              'name'        => $name,
              'type'        => 'series',
              'external_id' => $id,
              'created_at'  => now(),
              'updated_at'  => now(),
            ];
          })
          ->filter()
          ->all();
          
          $insert = array_merge($insert, $series);
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
      Log::error("TheMovieDB API Fehler: {$e->getMessage()}");
    }
  }
}
