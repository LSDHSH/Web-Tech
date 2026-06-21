<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
  public function run(): void
  { 
    try
    {
      $insert = [];
      
      for ($i = 0; $i < 250; $i += 100)
      { 
        $response = Http::withToken(config('services.apiKeys.country'))
        ->timeout(5)
        ->get('https://api.restcountries.com/countries/v5',
        [
          'limit'  => 100,
          'offset' => $i,
          'response_fields' => 'names.common,codes.alpha_3'
        ]);
        
        if ($response->successful())
        {
          $json = $response->json();
          
          $countries = collect($json['data']['objects'])
          ->map(function ($country)
          {
            $name = $country['names']['common'] ?? null;
            $code = $country['codes']['alpha_3'] ?? null;
            
            if (!$name || !$code)
              return null;
            
            return
            [
              'name'        => $name,
              'type'        => 'country',
              'external_id' => $code,
              'created_at'  => now(),
              'updated_at'  => now(),
            ];
          })
          ->filter()
          ->all();
          
          $insert = array_merge($insert, $countries);
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
      Log::error("RestCountries API Fehler: " . $e->getMessage());
    }
  }
}