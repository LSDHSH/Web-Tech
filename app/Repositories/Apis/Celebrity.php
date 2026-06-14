<?php

namespace App\Repositories\Apis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Celebrity extends Base
{
  public function __construct()
  {
    parent::__construct('https://api.themoviedb.org/3/person/', config('services.apiKeys.celebrity'));
  }
  
  public function random(): ?array
  {
    $gender = ['Not set / not specified', 'Female', 'Male', 'Non-binary'];
    
    for ($i = 0; $i < 30; $i++)
    {
      try
      {
        $id = rand(1, 100000); 
        
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
          
          if (!$json['birthday'])
            continue;
          
          $image = 'https://image.tmdb.org/t/p/w500';
          $json['profile_path'] = isset($json['profile_path']) ? $image . $json['profile_path'] : null;
          $json['gender'] =  $gender[$json['gender']];
          return $json;
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