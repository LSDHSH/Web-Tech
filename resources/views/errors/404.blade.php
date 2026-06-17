@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-4 py-6">

    <div class="text-center w-full max-w-md mb-6 shrink-0">
        <h1 class="text-5xl sm:text-6xl font-black tracking-tighter uppercase mb-2 select-none">
            <a href="{{ auth()->check() ? '/home' : '/' }}" class="hover:text-stone-700 dark:hover:text-stone-300 transition-colors">
                Guessle
            </a>
        </h1>
    </div>

    <div class="w-full max-w-md bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-center flex flex-col">
        
        <div class="p-4 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 flex justify-between items-center font-bold text-xs uppercase tracking-wider">
            <div>
                Status: <span class="bg-red-500 text-white px-2 py-0.5 font-black border border-black">Fehler</span>
            </div>
            <div class="font-mono font-black">
                CODE: 404
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white dark:bg-stone-900 flex-1 flex flex-col items-center justify-center">
            <div class="text-7xl sm:text-8xl font-black tracking-tighter uppercase mb-4 text-black dark:text-white bg-stone-100 dark:bg-stone-800 w-full py-6 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
                404
            </div>

            <h2 class="text-xl sm:text-2xl font-black uppercase tracking-tight mb-3 mt-4">
                Ungültiger Versuch!
            </h2>
            
            <p class="text-sm font-bold text-stone-500 dark:text-stone-400 font-mono uppercase mb-8 max-w-xs mx-auto">
                Diese Route existiert nicht in unserer Datenbank. Eventuell vertippt?
            </p>

            <a href="{{ auth()->check() ? '/home' : '/' }}"
               class="w-full block py-3 sm:py-4 bg-black text-white dark:bg-white dark:text-black font-black text-sm sm:text-base uppercase tracking-wider hover:bg-stone-800 dark:hover:bg-stone-200 transition-colors border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
                ← Zurück zum Hauptmenü
            </a>
        </div>

    </div>
</div>

@endsection