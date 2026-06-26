<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repositories\Api\ApiRepositoryInterface;

class CountryRepository implements ApiRepositoryInterface
{
  public function allNames(): array
  {
    return DB::table('searchable')
    ->where('type', 'country')
    ->orderBy('name', 'asc')
    ->pluck('name')
    ->toArray();
  }
  
  public function random(): array
  {
    $random = DB::table('searchable')
    ->where('type', 'country')
    ->inRandomOrder()
    ->get('external_id')
    ->first();

    if (!$random)
      return [];
    
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
        'name'          => $country['names']['common'],
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
    return [];
  }
  
  public function getDailyWordle(): ?array
  {
    $daily = DB::table('daily_wordle')
    ->where('type', 'country')
    ->latest('date')
    ->first();
    
    return $daily ? json_decode($daily->data, true) : null;
  }
  
  public function findByName($name): ?array
  {
    $result = DB::table('searchable')
    ->where('type', 'country')
    ->where('name', $name)
    ->get('external_id')
    ->first();
    
    if (!$result)
      return null;
    
    $country = $this->get($result->external_id);
    return empty($country) ? null : $country;
  }
}