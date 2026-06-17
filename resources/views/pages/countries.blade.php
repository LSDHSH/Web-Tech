@extends('layouts.app')

@section('content')
    <x-quiz-board 
        mode="Länder" 
        inputLabel="Welches Land wird gesucht?" 
        inputPlaceholder="Land eingeben (z.B. Japan...)" 
        inputId="country-input" 
        datalistId="countries" 
        tableBodyId="results-table"
    >
        <x-slot name="headers">
            <th class="p-3 text-center min-w-[110px] border-r-2 border-black dark:border-white">Land</th>
            <th class="p-3 text-center min-w-[95px] border-r-2 border-black dark:border-white">Kontinent</th>
            <th class="p-3 text-center min-w-[105px] border-r-2 border-black dark:border-white">Hauptstadt</th>
            <th class="p-3 text-center min-w-[95px] border-r-2 border-black dark:border-white">Einwohner</th>
            <th class="p-3 text-center min-w-[85px]">Währung</th>
        </x-slot>

        <x-slot name="scripts">
            <script>
                // Backend
                function makeGuess() { console.log("Länder-Rate-Logik hier einfügen"); }
            </script>
        </x-slot>
    </x-quiz-board>
@endsection