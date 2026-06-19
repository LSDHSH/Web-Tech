@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-4 bg-white dark:bg-stone-950 transition-colors">
    <div class="text-center w-full max-w-[600px] mb-8">
        <a href="/index" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-bold transition-colors">
            ← Back to Guessle
        </a>
    </div>

    <div class="w-full max-w-[600px] bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">

        <div class="flex flex-col sm:flex-row select-none shrink-0 text-lg">
            <div class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 border-b-4 border-black dark:border-white sm:border-r-2 last:sm:border-r-0 transition-colors">
                Log in
            </div>

            <a href="/register"
               class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-50 dark:bg-stone-850 text-stone-400 dark:text-stone-500 border-b-4 border-black dark:border-white hover:text-black dark:hover:text-white hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors">
                Sign up
            </a>
        </div>

        <form action="/login" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
            @csrf
            
            {{-- Status Notification --}}
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-4 text-sm font-medium text-emerald-700 dark:text-emerald-400 ring-1 ring-emerald-600/10 dark:ring-emerald-500/20">
                    {{ session('status') }}
                </div>
            @endif
            
            {{-- Error Notification --}}
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

                    <input type="email"
                           id="login-email"
                           name="email"
                           required
                           placeholder="your@mail.com"
                           class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="login-password" class="block text-sm uppercase font-black tracking-wider text-black dark:text-white">
                            Password
                        </label>

                        <a href="#"
                           class="text-xs uppercase tracking-wider text-stone-400 dark:text-stone-500 hover:text-black dark:hover:text-white hover:underline font-bold">
                            Forgot Password?
                        </a>
                    </div>

                    <input type="password"
                           id="login-password"
                           name="password"
                           required
                           placeholder="••••••••"
                           class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
                </div>

            </div>

            <x-submitbutton type="submit">
                Log in →
            </x-submitbutton>

        </form>
    </div>
</div>

@endsection