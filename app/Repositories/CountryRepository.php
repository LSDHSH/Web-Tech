<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CountryRepository
{
  public function random(): array
  {
    $random = DB::table('searchable')
    ->where('type', 'country')
    ->inRandomOrder()
    ->get('external_id')
    ->first();
    
    return $this->get($random->external_id);
  }
  
  public function get(string $id): array
  {
    $response = Http::withToken(config('services.apiKeys.country'))
    ->timeout(5)
    ->get('https://api.restcountries.com/countries/v5/code',
    [
      'q'  => $id
    ]);
    
    if ($response->successful())
    {
      $json = $response->json();
      $country = $json['data']['objects'][0];
      
      $borders = DB::table('searchable')
      ->where('type', 'country')
      ->whereIn('external_id', $country['borders'])
      ->pluck('name')
      ->all();
      
      return
      [
        'name'          => $country['names']['translations']['deu']['common'],
        'capitals'      => collect($country['capitals'])->pluck('name')->all(),
        
        'region'        => $country['region'],
        'subregion'     => $country['subregion'],
        'continents'    => $country['continents'],
        
        'population'    => $country['population'],
        'area'          => $country['area']['kilometers'],
        'currencies'    => collect($country['currencies'])->pluck('name')->all(),
        'languages'     => collect($country['languages'])->pluck('name')->all(),
        'driving_side'  => $country['cars']['driving_side'],
        
        'borders'       => $borders,
        'memberships'   => collect($country['memberships'])->filter()->keys()->all(),
        
        'flag'          => $country['flag']['url_png'],
      ];
    }
  }
}