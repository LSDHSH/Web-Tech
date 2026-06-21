<?php

namespace App\Services\Modi;

use App\Repositories\Api\MovieRepository;

class MovieMode implements ModeInterface
{
  private MovieRepository $repo;
  
  public function __construct(MovieRepository $repo)
  {
    $this->repo = $repo;
  }
  
  public function getLabel(): string
  {
    return 'Movie';
  }
  
  public function getSchema(): array
  {
    return
    [
      'name'          => ['Name', 'text'],
      'collection'    => ['Collection', 'boolean'],
      'genres'        => ['Genres', 'array'],
      'vote_average'  => ['Critic', 'number'],
      'budget'        => ['Budget', 'number'],
      'revenue'       => ['Revenue', 'number'],
      'runtime'       => ['Runtime', 'number'],
      'release_date'  => ['Release Date', 'date_year'],
    ];
  }
  
  public function getMaxAttempts(): int
  {
    return 8;
  }
  
  public function getRepository(): MovieRepository
  {
    return $this->repo;
  }
}