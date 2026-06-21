<?php

namespace App\Services\Modi;

use App\Repositories\Api\SeriesRepository;

class SeriesMode implements ModeInterface
{
  private SeriesRepository $repo;
  
  public function __construct(SeriesRepository $repo)
  {
    $this->repo = $repo;
  }
  
  public function getLabel(): string
  {
    return 'Series';
  }
  
  public function getSchema(): array
  {
    return
    [
      'name'               => ['Name', 'text'],
      'status'             => ['Status', 'text'],
      'genres'             => ['Genres', 'array'],
      'vote_average'       => ['Critic', 'number'],
      'number_of_seasons'  => ['Seasons', 'number'],
      'number_of_episodes' => ['Episodes', 'number'],
      'episode_run_time'   => ['Episode Runtime', 'number'],
      'first_air_date'     => ['Release Date', 'date_year'],
    ];
  }
  
  public function getMaxAttempts(): int
  {
    return 8;
  }
  
  public function getRepository(): SeriesRepository
  {
    return $this->repo;
  }
}