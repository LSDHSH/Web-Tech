<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		//
	}
	
	public function boot(): void
	{
		Gate::define('admin', function ($user)
		{
			return $user->hasRole('admin');
    });
		
		Event::listen(function (Login $event)
		{
			$event->user->update(
			[
				'last_login' => now(),
			]);
		});
	}
}
