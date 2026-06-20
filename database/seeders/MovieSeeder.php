<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
  public function run(): void
  { 
    try
    {
      $insert = [];
      $maxPages = 1;
      
      for ($i = 1; $i <= $maxPages; $i++)
      { 
        $response = Http::withToken(config('services.apiKeys.movie'))
        ->timeout(5)
        ->get('https://api.themoviedb.org/3/discover/movie',
        [
          'language' => 'en-US',
          'page' => $i,
          'vote_average.gte' => 8.0,
          'vote_count.gte' => 500
        ]);
        
        if ($response->successful())
        {
          $json = $response->json();
          $maxPages = $json['total_pages'];
          
          $movies = collect($json['results'])
          ->map(function ($movie)
          {
            $id = $movie['id'] ?? null;
            $name = $movie['title'] ?? null;
            
            if (!$name || !$id)
              return null;
            
            return
            [
              'name'        => $name,
              'type'        => 'movie',
              'external_id' => $id,
              'created_at'  => now(),
              'updated_at'  => now(),
            ];
          })
          ->filter()
          ->all();
          
          $insert = array_merge($insert, $movies);
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
      Log::error("TheMovieDB API Fehler: " . $e->getMessage());
    }
  }
}