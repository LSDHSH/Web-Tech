<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
  public function edit(): View
  {
    return view('pages.profile');
  }
  
  public function update(Request $request): RedirectResponse
  {
    $user = Auth::user();
    
    $request->validate(
    [
      'name' => ['required', 'string', 'max:255'],
      'password' => ['nullable', 'string', 'min:8'], 
    ]);
    
    $user->name = $request->input('name');
    
    if ($request->filled('password'))
      $user->password = Hash::make($request->input('password'));
    
    $user->save();
    return redirect()->back()->with('success', 'Profile successfully updated.');
  }
  
  public function destroy(Request $request): RedirectResponse
  {
    $user = Auth::user();
    Auth::logout();
    $user->delete();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Your Account has been deleted.');
  }
}