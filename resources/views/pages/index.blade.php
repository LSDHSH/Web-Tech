@extends('layouts.app')

@section('content')
<x-guessle-title-text1 />

<div class="w-full max-w-2xl text-center px-4">

    <div class="bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden transition-all">
        
        <div class="p-10 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800">
            <a href="/demoquiz" class="block w-full py-6 px-8 bg-black dark:bg-white text-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-bold text-2xl tracking-wide uppercase transition-colors text-center border-2 border-transparent dark:border-black">
                Start Quiz!
            </a>
            <p class="text-xs uppercase tracking-wider text-stone-500 dark:text-stone-400 mt-4 font-bold">
                Try out one free Quiz!
            </p>
        </div>

        <div class="p-10 flex flex-col gap-5 bg-white dark:bg-stone-900">
            <a href="/register" class="w-full py-4 px-6 bg-white dark:bg-stone-900 hover:bg-stone-100 dark:hover:bg-stone-800 text-black dark:text-white font-black uppercase tracking-wider text-lg border-4 border-black dark:border-white transition-colors text-center">
                Sign up
            </a>
            
            <a href="/login" class="w-full py-3 px-6 bg-transparent hover:underline text-stone-600 dark:text-stone-400 hover:text-black dark:hover:text-white font-black uppercase tracking-wider text-lg transition-all text-center">
                Log in
            </a>
        </div>

    </div>

    <p class="text-sm uppercase tracking-widest text-stone-400 dark:text-stone-500 mt-12 px-6 font-sans font-bold">
        Countries • Movies • Football • Videogames
    </p>
</div>
@endsection