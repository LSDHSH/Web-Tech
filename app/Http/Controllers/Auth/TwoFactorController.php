<?php

namespace App\Http\Controllers\Auth;

use Throwable;
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
		if (!session()->has('2fa_user'))
      return redirect('/login');
    
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
		
		return back()->withInput()->withErrors(['code' => 'Invalid or expired']);
	}
	
	public function resend()
	{
		$user = User::find(session('2fa_user'));
		$code = rand(100000, 999999);
		
		$user->fill(
		[
			'two_factor_code' => $code,
			'two_factor_expires_at' => Carbon::now()->addMinutes(10),
		])->save();
		
		try
		{
			Mail::raw("Your new two-factor code is: $code", function ($message) use ($user)
			{
				$message->to($user->email)->subject('Your new login confirmation code');
			});
		}
		catch (Throwable $e)
		{
      $user->fill(
      [
        'two_factor_code' => $user->two_factor_code,
        'two_factor_expires_at' => $user->two_factor_code,
      ])->save();

      logger()->error("2FA resend failed: {$e->getMessage()}");
      return back()->withInput()->withErrors(['code' => 'The new code could not be sent. Please try again.']);
    }
		
		return back()->withInput()->with('status', 'A new code has been sent to your inbox.');
	}
}
