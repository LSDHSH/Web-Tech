<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
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
		
		try
		{
      Mail::raw("Hi! Click here to activate your account:\n\n{$url}", function ($message) use ($request)
      {
        $message->to($request->email)->subject('Activate account');
      });
    }
		catch (Throwable $e)
		{
      session()->forget('registration');

      return redirect()->back()->withInput()->withErrors(['mail' => 'The activation email could not be sent. Please try again later.']);
    }

		return view('pages.auth.verify');
	}
	
	public function verify(Request $request)
	{
    $registration = session('registration');
		
    if (!$registration)
			return redirect('/register')->withErrors(['session' => 'Registration expired.']);
		
    if (User::where('email', $registration['email'])->exists())
      return redirect('/register')->withErrors(['email' => 'This email address has already been registered.']);
		
    $user = User::create(
		[
			'name' => $registration['name'],
			'email' => $registration['email'],
			'password' => $registration['password'],
			'email_verified_at' => now(),
    ]);

		$user->roles()->attach(2);
		
    session()->forget('registration');
		return redirect('/login')->with('status', 'Your account was successfully created!');
	}
}
