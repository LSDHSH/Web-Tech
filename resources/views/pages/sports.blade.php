@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Sportler" 
        inputLabel="Welcher Athlet wird gesucht?" 
        inputPlaceholder="Sportler eingeben (z.B. Messi...)" 
        inputId="sport-input" 
        datalistId="sports" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[120px] border-r-2 border-black dark:border-white">Athlet</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Sportart</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Nation</th>
            <th class="p-3 text-center min-w-[80px] border-r-2 border-black dark:border-white">Alter</th>
            <th class="p-3 text-center min-w-[80px]">Nummer</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                function makeGuess() { console.log("Sport-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection