<?php

namespace App\Repositories\Apis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Movie extends Base
{
  public function __construct()
  {
    parent::__construct('https://api.themoviedb.org/3/movie', config('services.apiKeys.movie'));
  }
  
  public function random(): ?array
  {
    for ($i = 0; $i < 10; $i++)
    {
      try
      {
        $id = rand(1, 88000); 
        
        $response = Http::withToken($this->key)
        ->timeout(3)
        ->get("{$this->url}/{$id}",
        [
          'language' => 'de-DE',
          'append_to_response' => 'videos,images',
          'include_image_language' => 'de,en,null',
        ]);
        
        if ($response->successful())
        {
          $json = $response->json();
          
          if (!empty($json['spoken_languages']))
          {
            if (!collect($json['spoken_languages'])->contains('iso_639_1', 'en'))
              continue;
            
            $image = 'https://image.tmdb.org/t/p/w500';
            $json['poster_path'] = isset($json['poster_path']) ? $image . $json['poster_path'] : null;
            return $json;
          }
        }
      }
      catch (\Exception $e)
      {
        Log::warning("TMDB Random Movie Fehler: {$e->getMessage()}");
      }
    }
    
    return null;
  }
}