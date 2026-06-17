@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Filme" 
        inputLabel="Welcher Film wird gesucht?" 
        inputPlaceholder="Film eingeben (z.B. Interstellar...)" 
        inputId="movie-input" 
        datalistId="movies" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[120px] border-r-2 border-black dark:border-white">Film</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Genre</th>
            <th class="p-3 text-center min-w-[90px] border-r-2 border-black dark:border-white">Release</th>
            <th class="p-3 text-center min-w-[110px] border-r-2 border-black dark:border-white">Regisseur</th>
            <th class="p-3 text-center min-w-[85px]">Länge</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                function makeGuess() { console.log("Film-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection