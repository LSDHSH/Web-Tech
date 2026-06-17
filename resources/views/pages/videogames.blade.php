@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Videospiele" 
        inputLabel="Welches Spiel wird gesucht?" 
        inputPlaceholder="Spiel eingeben (z.B. Skyrim...)" 
        inputId="game-input" 
        datalistId="games" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[120px] border-r-2 border-black dark:border-white">Spiel</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Genre</th>
            <th class="p-3 text-center min-w-[90px] border-r-2 border-black dark:border-white">Release</th>
            <th class="p-3 text-center min-w-[110px] border-r-2 border-black dark:border-white">Studio</th>
            <th class="p-3 text-center min-w-[90px]">Plattform</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                function makeGuess() { console.log("Videospiel-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection