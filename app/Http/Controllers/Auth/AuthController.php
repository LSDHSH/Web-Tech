<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function show()
	{
		return view('pages.auth.login');
	}
	
	public function login(Request $request)
	{
    $credentials = $request->validate(
		[
			'email' => 'required|email',
			'password' => 'required',
    ]);
		
		if (! Auth::validate($credentials))
			return back()->withInput()->withErrors(['email' => 'The login details provided are incorrect.',]);
		
		$user = User::where('email', $credentials['email'])->first();
		$code = random_int(100000, 999999);
		
		$user->fill(
		[
			'two_factor_code' => $code,
			'two_factor_expires_at' => now()->addMinutes(10),
		])->save();
		
		session(['2fa_user' => $user->id,]);

		try
		{
			Mail::raw("Your two-factor code is: $code", function ($message) use ($user)
			{
				$message->to($user->email)->subject('Your login code');
			});
		}
		catch (Throwable $e)
		{
			session()->forget('2fa_user');
      
      $user->fill(
			[
        'two_factor_code' => null,
        'two_factor_expires_at' => null,
      ])->save();

      logger()->error("FA mail delivery failed: {$e->getMessage()}");

      return back()->withInput()->withErrors(['email' => 'The confirmation code could not be sent. Please try again later.']);
		}
		
		return redirect('/2fa');
	}
	
	public function logout(Request $request)
	{
		Auth::logout();
		session()->forget('2fa_user');
		$request->session()->regenerateToken();
		return redirect('/login');
	}
}
