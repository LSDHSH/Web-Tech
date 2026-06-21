<?php

namespace App\Services\Modi;

use App\Repositories\Api\ApiRepositoryInterface;

interface ModeInterface
{
  public function getLabel(): string;
  public function getSchema(): array;
  public function getMaxAttempts(): int;
  public function getRepository(): ApiRepositoryInterface;
}