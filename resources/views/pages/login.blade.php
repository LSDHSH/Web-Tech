@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-4">

    <div class="text-center w-full max-w-[600px] mb-8">
        <a href="/index" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black font-bold transition-colors">
            ← Back to Guessle
        </a>
    </div>

    <div class="w-full max-w-[600px] bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden text-left flex flex-col">

        <!-- Tabs -->
        <div class="flex flex-col sm:flex-row select-none shrink-0 text-lg">
            <div class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-white border-b-4 sm:border-b-4 border-black">
                Log in
            </div>

            <a href="/register"
               class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-100 text-stone-400 border-b-4 sm:border-b-4 sm:border-l-4 border-black hover:text-black transition-colors">
                Sign up
            </a>
        </div>

        <!-- Form -->
        <form action="/login" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
            @csrf

            <div class="space-y-6">

                <div>
                    <label for="login-email" class="block text-sm uppercase font-black tracking-wider mb-2">
                        Email Address
                    </label>

                    <input type="email"
                           id="login-email"
                           name="email"
                           required
                           placeholder="your@mail.com"
                           class="w-full p-3 sm:p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="login-password" class="block text-sm uppercase font-black tracking-wider">
                            Password
                        </label>

                        <a href="#"
                           class="text-xs uppercase tracking-wider text-stone-400 hover:text-black hover:underline font-bold">
                            Forgot Password?
                        </a>
                    </div>

                    <input type="password"
                           id="login-password"
                           name="password"
                           required
                           placeholder="••••••••"
                           class="w-full p-3 sm:p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold">
                </div>

            </div>

            <x-button type="submit">
                Log in →
            </x-button>

        </form>
        

    </div>

</div>

@endsection