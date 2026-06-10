@extends('layouts.app')

@section('content')
<a href="/profile" class="fixed top-6 right-36 p-3 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none flex items-center gap-2 font-black uppercase tracking-wider text-sm transition-all z-50 cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
    </svg>
    <span class="hidden sm:inline">Profil</span>
</a>


<x-guessle-title-text1 />

<div class="w-full max-w-xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
    
    <div class="flex flex-col divide-y-4 divide-black dark:divide-white">
        
        <x-quiz-link href="/quiz/countries" title="Countries" />
        <x-quiz-link href="/quiz/movies" title="Movies" />
        <x-quiz-link href="/quiz/celebs" title="Celebs" />
        <x-quiz-link href="/quiz/sports" title="Sports" />
        <x-quiz-link href="/quiz/videogames" title="Videogames" />

    </div>

</div>
@endsection