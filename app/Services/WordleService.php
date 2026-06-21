<?php

namespace App\Services;

use App\Services\Modi\GameMode;
use App\Services\Modi\MovieMode;
use App\Services\Modi\SeriesMode;
use App\Services\Modi\CountryMode;
use App\Services\Modi\ModeInterface;
use Illuminate\Support\Facades\Session;

class WordleService
{
  protected function getMode(string $mode): ModeInterface
  {
    $class = match ($mode)
    {
      'games'     => GameMode::class,
      'movies'    => MovieMode::class,
      'series'    => SeriesMode::class,
      'countries' => CountryMode::class,
      default     => abort(404, "Für den Modus [{$mode}] ist kein Spielmodus registriert."),
    };
    
    return app($class);
  }
  
  protected function getSessionKey(string $mode): string
  {
    $today = date('Y-m-d');
    return "wordle.{$mode}.{$today}";
  }
  
  public function getGameState(string $mode): array
  {
    return Session::get($this->getSessionKey($mode),
    [
      'status'   => 'playing', 
      'attempts' => 0,
      'history'  => []
    ]);
  }
  
  public function start(string $mode): array
  {
    $class = $this->getMode($mode);
    $schema = $class->getSchema();
    $repo = $class->getRepository();
    $maxAttempts = method_exists($class, 'getMaxAttempts') ? $class->getMaxAttempts() : 8;
    $state = $this->getGameState($mode);
    $solution = $repo->getDailyWordle();
    
    $data =
    [
      'mode'             => $mode,
      'label'            => $class->getLabel(),
      'headers'          => array_map(fn($item) => $item[0], array_values($schema)),
      'options'          => $repo->allNames(),
      'max_attempts'     => $maxAttempts, // JETZT DYNAMISCH
      'current_attempts' => $state['attempts'],
      'game_status'      => $state['status'],
      'history'          => $state['history'],
      'solution'         => null
    ];
    
    if ($state['status'] === 'lost' && $solution)
      $data['solution'] = $solution['name'] ?? 'Unbekannt';
    
    return $data;
  }
  
  public function check(string $mode, string $guess): array
  {
    $modeStr = $mode;
    $mode = $this->getMode($mode);
    $repo = $mode->getRepository();
    $solution = $repo->getDailyWordle();
    $guessEntity = $repo->findByName($guess);
    
    if (!$solution)
      throw new \Exception("Für heute wurde noch kein Wordle generiert.", 404);
    
    if (!$guessEntity)
      throw new \Exception("Der Tipp existiert nicht in der Datenbank.", 422);
    
    $state = $this->getGameState($modeStr);
    if ($state['status'] !== 'playing')
      throw new \Exception("Dieses Spiel für heute ist bereits beendet.", 400);
    
    $maxAttempts = method_exists($mode, 'getMaxAttempts') ? $mode->getMaxAttempts() : 8;    
    $schema = $mode->getSchema();
    $evaluated = [];
    $won = true; 
    
    foreach ($schema as $key => $config)
    {
      $label = $config[0]; 
      $type = $config[1]; 
      $solVal   = $solution[$key] ?? null;
      $guessVal = $guessEntity[$key] ?? null;
      
      $result = match ($type)
      {
        'text'      => $this->compareText($solVal, $guessVal),
        'number'    => $this->compareNumber($solVal, $guessVal),
        'date_year' => $this->compareDateYear($solVal, $guessVal),
        'array'     => $this->compareArray($solVal, $guessVal),
        'boolean'   => $this->compareBoolean($solVal, $guessVal),
        'count'     => $this->compareCount($solVal, $guessVal),
        default     => ['status' => 'wrong', 'display' => $guessVal]
      };
      
      if ($result['status'] !== 'correct')
        $won = false;
      
      $evaluated[] =
      [
        'header' => $label,
        'type'   => $type,
        'value'  => $result['display'] ?? '-',
        'status' => $result['status']
      ];
    }
    
    $state['attempts']++;
    $state['history'][] = $evaluated;
    
    if ($won)
      $state['status'] = 'won';
    elseif ($state['attempts'] >= $maxAttempts)
      $state['status'] = 'lost';
    
    
    Session::put($this->getSessionKey($modeStr), $state);
    
    $response =
    [
      'success' => $won,
      'results' => $evaluated,
      'status'  => $state['status'],
      'attempts'=> $state['attempts']
    ];
    
    if ($state['status'] === 'lost')
      $response['solution'] = $solution['name'] ?? 'Unbekannt';
    
    return $response;
  }
  
  protected function compareText($solVal, $guessVal): array
  {
    $isMatch = (strtoupper(trim($solVal ?? '')) === strtoupper(trim($guessVal ?? '')));
    
    return
    [
      'status'  => $isMatch ? 'correct' : 'wrong',
      'display' => $guessVal
    ];
  }
  
  protected function compareNumber($solVal, $guessVal): array
  {
    if ($guessVal == $solVal)
      $status = 'correct';
    else
      $status = ($guessVal < $solVal) ? 'higher' : 'lower';
      
    return
    [
      'status'  => $status,
      'display' => $guessVal
    ];
  }
  
  protected function compareDateYear($solVal, $guessVal): array
  {
    $solYear   = $solVal ? date('Y', strtotime($solVal)) : null;
    $guessYear = $guessVal ? date('Y', strtotime($guessVal)) : null;
    
    if ($guessYear == $solYear)
      $status = 'correct';
    else 
      $status = ($guessYear < $solYear) ? 'higher' : 'lower';
    
    return
    [
      'status'  => $status,
      'display' => $guessYear
    ];
  }
  
  protected function compareArray($solVal, $guessVal): array
  {
    $solArray   = is_array($solVal) ? $solVal : ($solVal ? [$solVal] : []);
    $guessArray = is_array($guessVal) ? $guessVal : ($guessVal ? [$guessVal] : []);
    $intersect = array_intersect($guessArray, $solArray);
    $display = [];
    
    foreach ($guessArray as $item)
    {
      $display[] =
      [
        'value'  => $item,
        'status' => in_array($item, $solArray) ? 'correct' : 'wrong'
      ];
    }
    
    if (count($intersect) === count($solArray) && count($guessArray) === count($solArray))
      $status = 'correct'; 
    elseif (count($intersect) > 0)
      $status = 'partial';
    else
      $status = 'wrong';
    
    return
    [
      'status'  => $status,
      'display' => $display
    ];
  }
  
  protected function compareBoolean($solVal, $guessVal): array
  {
    $isMatch = ((bool)$solVal === (bool)$guessVal);
    
    return
    [
      'status'  => $isMatch ? 'correct' : 'wrong',
      'display' => $guessVal ? 'True' : 'False'
    ];
  }
  
  protected function compareCount($solVal, $guessVal): array
  {
    $solCount   = is_array($solVal)   ? count($solVal)   : (int)$solVal;
    $guessCount = is_array($guessVal) ? count($guessVal) : (int)$guessVal;
    
    if ($guessCount == $solCount)
      $status = 'correct';
    else
      $status = ($guessCount < $solCount) ? 'higher' : 'lower';
    
    return
    [
      'status'  => $status,
      'display' => $guessCount 
    ];
  }
}