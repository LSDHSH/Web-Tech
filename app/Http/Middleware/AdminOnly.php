<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
	public function handle(Request $request, Closure $next)
	{
		if (auth()->check() && auth()->user()->hasRole('admin'))
			return $next($request);
		
		return redirect('/home')->with('error', 'You do not have admin rights.');
	}
}
