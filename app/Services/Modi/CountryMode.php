<?php

namespace App\Services\Modi;

use App\Repositories\Api\CountryRepository;

class CountryMode implements ModeInterface
{
  private CountryRepository $repo;
  
  public function __construct(CountryRepository $repo)
  {
    $this->repo = $repo;
  }
  
  public function getLabel(): string
  {
    return 'Country';
  }
  
  public function getSchema(): array
  {
    return
    [
      'name'         => ['Name', 'text'],
      'continents'   => ['Continent', 'array'],
      'population'   => ['Population', 'number'],
      'area'         => ['Area', 'number'],
      'driving_side' => ['Driving Side', 'text'],
      'languages'    => ['Languages', 'array'],
      'currencies'   => ['Currencies', 'array'],
    ];
  }
  
  public function getMaxAttempts(): int
  {
    return 8;
  }
  
  public function getRepository(): CountryRepository
  {
    return $this->repo;
  }
}