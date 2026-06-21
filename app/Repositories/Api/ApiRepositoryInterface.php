<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

interface ApiRepositoryInterface
{
  public function random(): array;
  public function allNames(): array;
  public function get(string $id): array;
  public function getDailyWordle(): ?array;
  public function findByName($name): ?array;
}