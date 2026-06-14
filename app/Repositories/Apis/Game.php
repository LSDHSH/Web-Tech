<?php

namespace App\Repositories\Apis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Game extends Base
{
  public function __construct()
  {
    parent::__construct('https://www.thesportsdb.com/documentation#base_url', config('services.apiKeys.game'));
  }
  
  public function random(): ?array
  {
    try
    {
      $offset = rand(0, 249);
      
      $response = Http::withToken($this->key)
      ->timeout(5)
      ->get($this->url,
      [
        
      ]);
      
      if ($response->successful())
      {
        $json = $response->json();
        
      }
    }
    catch (\Exception $e)
    {
      Log::error("RestCountries API Fehler: $e->getMessage()");
    }
    
    return null;
  }
}