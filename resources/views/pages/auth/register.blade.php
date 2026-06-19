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

            <a href="/login"
               class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-50 dark:bg-stone-850 text-stone-400 dark:text-stone-500 border-b-4 border-black dark:border-white sm:border-r-4 hover:text-black dark:hover:text-white hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors">
                Log in
            </a>

            <div class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200 border-b-4 border-black dark:border-white transition-colors">
                Sign up
            </div>

        </div>

        <form action="/register" method="POST" class="p-6 sm:p-10 space-y-6 flex-1 flex flex-col justify-between">
            @csrf
            
            {{-- Error Notification --}}
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-5">

                <div>
                    <label for="reg-username" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
                        Username
                    </label>

                    <input type="text"
                           id="reg-username"
                           name="username"
                           required
                           placeholder="Max von Schilksee"
                           class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
                </div>

                <div>
                    <label for="reg-email" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
                        Email Address
                    </label>

                    <input type="email"
                           id="reg-email"
                           name="email"
                           required
                           placeholder="your@mail.com"
                           class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
                </div>

                <div>
                    <label for="reg-password" class="block text-sm uppercase font-black tracking-wider mb-2 text-black dark:text-white">
                        Password
                    </label>

                    <input type="password"
                           id="reg-password"
                           name="password"
                           required
                           placeholder="At least 8 characters"
                           class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 dark:placeholder-stone-500 font-bold">
                </div>

                <div class="text-xs text-stone-500 dark:text-stone-400 uppercase tracking-wider leading-relaxed pt-2 font-bold">
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