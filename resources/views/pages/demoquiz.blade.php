@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center px-4 py-6">

    <div class="text-center w-full max-w-xl mb-8 shrink-0">
        <h1 class="text-5xl sm:text-7xl font-black tracking-tighter uppercase mb-2">
            <a href="{{ auth()->check() ? '/home' : '/' }}" class="hover:text-stone-700 dark:hover:text-stone-300 transition-colors select-none">
                Guessle
            </a>
        </h1>

        <a href="/index"
           class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-bold transition-colors mb-4">
            ← Zurück zur Startseite
        </a>
    </div>

    <div class="w-full max-w-xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">

        <div class="p-4 sm:p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 font-bold text-xs sm:text-sm uppercase tracking-wider">
            <div>
                Modus:
                <span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5">Länder-Demo</span>
            </div>
            <div id="try-counter">
                Lade Länderdaten...
            </div>
        </div>

        <div class="p-4 sm:p-8 border-b-4 border-black dark:border-white bg-white dark:bg-stone-900">
            <label for="country-input" class="block text-sm uppercase font-black tracking-wider mb-3">
                Welches Land wird gesucht?
            </label>

            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text"
                       id="country-input"
                       list="countries"
                       autocomplete="off"
                       disabled
                       placeholder="Bitte warten..."
                       class="flex-1 p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base sm:text-lg focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 font-bold disabled:opacity-50">

                <button id="guess-btn" onclick="makeGuess()" disabled
                        class="px-6 sm:px-8 py-3 sm:py-0 bg-black text-white dark:bg-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-black text-base sm:text-lg tracking-wide uppercase transition-colors cursor-pointer disabled:opacity-50">
                    Rate!
                </button>
            </div>

            <datalist id="countries"></datalist>
        </div>
<div class="p-4 sm:p-6 bg-stone-50 dark:bg-stone-800 overflow-x-auto min-h-[250px] scrollbar-thin">
            <table class="w-max sm:w-full text-center font-mono text-[11px] sm:text-xs uppercase tracking-wider border-collapse border-2 border-black dark:border-white mx-auto">
                <thead>
                    <tr class="bg-stone-200 dark:bg-stone-700 border-b-4 border-black dark:border-white font-black text-black dark:text-white">
                        <th class="p-3 text-center min-w-[110px] border-r-2 border-black dark:border-white">Land</th>
                        <th class="p-3 text-center min-w-[95px] border-r-2 border-black dark:border-white">Kontinent</th>
                        <th class="p-3 text-center min-w-[105px] border-r-2 border-black dark:border-white">Hauptstadt</th>
                        <th class="p-3 text-center min-w-[95px] border-r-2 border-black dark:border-white">Einwohner</th>
                        <th class="p-3 text-center min-w-[85px]">Währung</th>
                    </tr>
                </thead>
                <tbody id="results-table" class="divide-y-2 divide-black dark:divide-white">
                    </tbody>
            </table>

            <div id="game-status" class="mt-8 text-center hidden">
                <h2 id="status-title" class="text-2xl sm:text-3xl font-black uppercase tracking-tighter mb-4"></h2>
                <p id="status-text" class="text-sm font-bold text-stone-500 dark:text-stone-400 mb-4"></p>
                <a href="/register"
                   class="inline-block py-3 sm:py-4 px-6 sm:px-8 bg-black text-white dark:bg-white dark:text-black font-black text-sm sm:text-base uppercase tracking-wider hover:bg-stone-800 dark:hover:bg-stone-200 transition-colors border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Jetzt registrieren & alle Modi freischalten →
                </a>
            </div>
        </div>
    </div>
</div>

@endsection