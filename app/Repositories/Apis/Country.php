<?php

namespace App\Repositories\Apis;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Country extends Base
{
  public function __construct()
  {
    parent::__construct('https://api.restcountries.com/countries/v5', config('services.apiKeys.country'));
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
        'limit'  => 1,
        'offset' => $offset,
      ]);
      
      if ($response->successful())
      {
        $json = $response->json();
        $country = $json['data']['objects'][0] ?? null;
        
        if ($country)
          return $country;
      }
    }
    catch (\Exception $e)
    {
      Log::error("RestCountries API Fehler: " . $e->getMessage());
    }
    
    return null;
  }
}