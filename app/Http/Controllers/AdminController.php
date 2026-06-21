<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view('pages.admin', compact('users'));
  }
  
  public function update(Request $request, User $user)
  {
    $request->validate(
    [
      'name' => 'required|string|max:255',
      'role' => 'required|string',
    ]);
    
    $user->update(['name' => $request->name]);
    $role = Role::where('name', $request->role)->first();
    $user->roles()->sync([$role->id]);
    
    if (auth()->id() === $user->id)
    {
      if (!$user->hasRole('admin'))
        return redirect('/home')->with('info', 'You removed your own admin rights.');
    }
    
    return back()->with('success', 'User updated successfully.');
  }
  
  public function destroy(User $user)
  {
    DB::table('sessions')->where('user_id', $user->id)->delete();
    $user->roles()->detach();
    $user->delete();
    return back()->with('success', 'User deleted.');
  }
}
