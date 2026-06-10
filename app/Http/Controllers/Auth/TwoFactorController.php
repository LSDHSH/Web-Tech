<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
	public function show()
	{
		return view('pages.auth.2fa');
	}
	
	public function verify(Request $request)
	{
		$request->validate(
		[
			'code' => 'required|numeric',
		]);
		
		$user = User::find(session('2fa_user'));
		
		if (! $user) 
			return redirect('/login');
		
		if ($request->code == $user->two_factor_code && now()->isBefore($user->two_factor_expires_at))
		{
			$user->forceFill(
			[
				'two_factor_code' => null,
				'two_factor_expires_at' => null,
			])->save();
			
			Auth::login($user);
			$request->session()->regenerate();
			session()->forget('2fa_user');
			return redirect('/home');
		}
		
		return back()->withErrors(['code' => 'Ungültig oder abgelaufen']);
	}
	
	// Code erneut senden, falls die Mail verloren ging
	public function resend()
	{
		$user = User::find(session('2fa_user'));
		$code = rand(100000, 999999);
		
		$user->fill(
		[
			'two_factor_code' => $code,
			'two_factor_expires_at' => Carbon::now()->addMinutes(10),
		])->save();
		
		Mail::raw("Dein neuer Zwei-Faktor-Code lautet: $code", function ($message) use ($user)
		{
			$message->to($user->email)->subject('Dein neuer Login-Bestätigungscode');
		});
		
		return back()->with('status', 'Ein neuer Code wurde an dein Postfach gesendet.');
	}
}
