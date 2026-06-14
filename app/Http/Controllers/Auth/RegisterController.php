<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
	public function show()
	{
		return view('pages.auth.register');
	}
	
	public function register(Request $request)
	{
		$request->validate(
		[
			'username' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8',
		]);
		
		session()->put('registration',
		[
			'name' => $request->username,
			'email' => $request->email,
			'password' => bcrypt($request->password),
    ]);
		
    $url = URL::temporarySignedRoute('verify', Carbon::now()->addMinutes(5));
		
    Mail::raw("Hi! Klicke hier um dein Konto zu aktivieren:\n\n{$url}", function ($message) use ($request)
		{
			$message->to($request->email)->subject('Konto aktivieren');
    });
		
		return view('pages.auth.verify');
	}
	
	public function verify(Request $request)
	{
    $registration = session('registration');
		
    if (!$registration)
			return redirect('/register')->withErrors(['session' => 'Registrierung abgelaufen.']);
		
    if (User::where('email', $registration['email'])->exists())
      return redirect('/register')->withErrors(['email' => 'Diese E-Mail-Adresse wurde bereits registriert.']);
		
    User::create(
		[
			'name' => $registration['name'],
			'email' => $registration['email'],
			'password' => $registration['password'],
			'email_verified_at' => now(),
    ]);
		
    session()->forget('registration');
		return redirect('/login')->with('status', 'Dein Account wurde erfolgreich erstellt!');
	}
}
