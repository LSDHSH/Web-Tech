<?php

namespace App\Services\Modi;

use App\Repositories\Api\GameRepository;

class GameMode implements ModeInterface
{
  private GameRepository $repo;
  
  public function __construct(GameRepository $repo)
  {
    $this->repo = $repo;
  }
  
  public function getLabel(): string
  {
    return 'Game';
  }
  
  public function getSchema(): array
  {
    return
    [
      'name'          => ['Name', 'text'],
      'series'        => ['Series', 'text'],
      'genres'        => ['Genres', 'array'],
      'metacritic'    => ['Critic', 'number'],
      'achievements'  => ['Achievements', 'number'],
      'released'      => ['Released', 'date_year'],
      'platforms'     => ['Platforms', 'array'],
    ];
  }
  
  public function getMaxAttempts(): int
  {
    return 8;
  }
  
  public function getRepository(): GameRepository
  {
    return $this->repo;
  }
}