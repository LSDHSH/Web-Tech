<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function show()
	{
		return view("pages.auth.login");
	}
	
	public function login(Request $request)
	{
    $credentials = $request->validate(
		[
			'email' => 'required|email',
			'password' => 'required',
    ]);
		
		if (! Auth::validate($credentials))
			return back()->withErrors(['email' => 'Die angegebenen Anmeldedaten sind falsch.',]);
		
		$user = User::where('email', $credentials['email'])->first();
		$code = random_int(100000, 999999);
		
		$user->fill([
			'two_factor_code' => $code,
			'two_factor_expires_at' => now()->addMinutes(10),
		])->save();
		
		session(['2fa_user' => $user->id,]);
		
		Mail::raw("Dein Zwei-Faktor-Code lautet: $code", function ($message) use ($user)
		{
			$message->to($user->email)->subject('Dein Login-Code');
		});
		
		return redirect('/2fa');
	}
	
	public function logout(Request $request)
	{
		Auth::logout();
		session()->forget('2fa_user');
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/login');
	}
}
