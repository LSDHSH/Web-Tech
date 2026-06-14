<?php

namespace App\Repositories\Apis;

abstract class Base
{
  protected string $url;
  protected string $key;
  
  public function __construct(string $url, string $key)
  {
    $this->url = $url;
    $this->key = $key;
  }
  
  abstract public function random(): ?array;
}