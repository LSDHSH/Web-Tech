<?php

namespace App\Http\Controllers;

use Throwable;
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
  
  public function show(string $mode)
  {
    try
    {
      $game = $this->service->start($mode);
      return view('pages.wordle', $game);
    }
    catch (Throwable $e)
    {
      return back()->withErrors(['game_error' => $e->getMessage()]);
    }
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
      return response()->json(['error' => "Failed to call API"], 422);
    }
  }
}