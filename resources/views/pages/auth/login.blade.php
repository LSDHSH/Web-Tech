@extends('layouts.app')

@section('content')
<x-auth.card active="login">
	<form action="/login" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
		@csrf
		
		@if (session('status'))
			<div class="mb-4 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-4 text-sm font-medium text-emerald-700 dark:text-emerald-400 ring-1 ring-emerald-600/10 dark:ring-emerald-500/20">
				{{ session('status') }}
			</div>
		@endif
		
		@error('email')
			<div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
				{{ $message }}
			</div>
		@enderror
		
		<div class="space-y-6">   
			<div>
				<label for="login-email" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
					Email Address
				</label>
				<input type="email" id="login-email" name="email" required placeholder="your@mail.com"	class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
			</div>
			
			<div>
				<div class="flex justify-between items-center mb-2">
					<label for="login-password" class="block text-sm uppercase font-black tracking-wider text-black dark:text-white">
						Password
					</label>
				</div>
				<input type="password" id="login-password" name="password" required placeholder="••••••••"	class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
			</div>
		</div>
		
		<x-form.submit-button type="submit">
			Log in →
		</x-form.submit-button>
	</form>
</x-auth.card>
@endsection