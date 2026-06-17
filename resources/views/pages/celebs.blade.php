@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Promis" 
        inputLabel="Welcher Promi wird gesucht?" 
        inputPlaceholder="Name eingeben (z.B. Brad Pitt...)" 
        inputId="celeb-input" 
        datalistId="celebs" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[120px] border-r-2 border-black dark:border-white">Name</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Beruf</th>
            <th class="p-3 text-center min-w-[80px] border-r-2 border-black dark:border-white">Alter</th>
            <th class="p-3 text-center min-w-[110px] border-r-2 border-black dark:border-white">Herkunft</th>
            <th class="p-3 text-center min-w-[90px]">Net Worth</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                function makeGuess() { console.log("Promi-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection