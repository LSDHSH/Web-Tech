<?php

namespace App\Repositories\Apis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Sport extends Base
{
  public function __construct()
  {
    parent::__construct('', config('services.apiKeys.sport'));
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
      Log::error('TheSportsDB API Fehler: ' . $e->getMessage());
    }
    
    return null;
  }
}