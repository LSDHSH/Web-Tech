<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\WordleService;

class WordleController extends Controller
{
  protected WordleService $service;
  
  public function __construct(WordleService $service)
  {
    $this->service = $service;
  }
  
  public function show(string $mode): View
  {
    $game = $this->service->start($mode);
    return view('pages.wordle', $game);
  }
  
  public function guess(Request $request, string $mode)
  {
    $request->validate(
    [
      'guess' => 'required|string',
    ]);
    
    try
    {
      $result = $this->service->check($mode, $request->input('guess'));
      return response()->json($result);
    }
    catch (\Exception $e)
    {
      return response()->json(['error' => $e->getMessage()], 422);
    }
  }
}