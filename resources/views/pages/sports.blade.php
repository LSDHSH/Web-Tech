@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Verein" 
        inputLabel="Welcher Verein wird gesucht?" 
        inputPlaceholder="Team eingeben (z.B. TSV Schilksee...)" 
        inputId="sport-input" 
        datalistId="sports" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[120px] border-r-2 border-black dark:border-white">Verein</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Sportart</th>
            <th class="p-3 text-center min-w-[100px] border-r-2 border-black dark:border-white">Nation</th>
            <th class="p-3 text-center min-w-[80px] border-r-2 border-black dark:border-white">Alter</th>
            <th class="p-3 text-center min-w-[80px]">Liga</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                function makeGuess() { console.log("Sport-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection