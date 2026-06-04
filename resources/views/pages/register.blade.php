@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-4">

    <!-- Back Link -->
    <div class="text-center w-full max-w-[600px] mb-8">
        <a href="/index" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black font-bold transition-colors">
            ← Back to Guessle
        </a>
    </div>

    <!-- Card -->
    <div class="w-full max-w-[600px] bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden text-left flex flex-col">

        <!-- Tabs -->
        <div class="flex flex-col sm:flex-row select-none shrink-0 text-lg">

            <a href="/login"
               class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-100 text-stone-400 border-b-4 sm:border-b-4 sm:border-r-4 border-black hover:text-black transition-colors">
                Log in
            </a>

            <div class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-white border-b-4 border-black">
                Sign up
            </div>

        </div>

        <!-- Form -->
        <form action="/register" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
            @csrf

            <div class="space-y-5">

                <div>
                    <label for="reg-username" class="block text-sm uppercase font-black tracking-wider mb-2">
                        Username
                    </label>
                    @error('username')
                        <div class="text-red">{{ $message }}</div>
                    @enderror

                    <input type="text"
                           id="reg-username"
                           name="username"
                           required
                           placeholder="Max von Schilksee"
                           class="w-full p-3 sm:p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold">
                </div>

                <div>
                    <label for="reg-email" class="block text-sm uppercase font-black tracking-wider mb-2">
                        Email Address
                    </label>
                    @error('email')
                        <div class="text-red">{{ $message }}</div>
                    @enderror

                    <input type="email"
                           id="reg-email"
                           name="email"
                           required
                           placeholder="your@mail.com"
                           class="w-full p-3 sm:p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold">
                </div>

                <div>
                    <label for="reg-password" class="block text-sm uppercase font-black tracking-wider mb-2">
                        Password
                    </label>
                    @error('password')
                        <div class="text-red">{{ $message }}</div>
                    @enderror

                    <input type="password"
                           id="reg-password"
                           name="password"
                           required
                           placeholder="At least 8 characters"
                           class="w-full p-3 sm:p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold">
                </div>

                <div class="text-xs text-stone-500 uppercase tracking-wider leading-relaxed pt-2 font-bold">
                    By creating an account, you agree to our use of cookies to save your score locally. We'll send you a confirmation email after registration.
                </div>

            </div>

            <x-submitbutton type="submit">
                Create Account →
            </x-submitbutton>

        </form>

    </div>

</div>

@endsection