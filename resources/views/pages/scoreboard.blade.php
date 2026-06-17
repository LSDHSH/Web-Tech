@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center px-4 py-6">

    <div class="text-center w-full max-w-2xl mb-6 shrink-0 px-4">
        <x-guessle-title-text1 />
        
        <p class="text-sm font-black uppercase tracking-widest text-stone-500">
            Bestenliste
        </p>
    </div>

    <div class="w-full max-w-2xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
        
        <div class="flex border-b-4 border-black dark:border-white overflow-x-auto bg-stone-100 dark:bg-stone-800 scrollbar-none font-black text-xs uppercase tracking-wider">
            <button onclick="switchTab('countries')" id="tab-countries" class="tab-btn flex-1 min-w-[90px] py-4 px-2 border-r-2 border-black dark:border-white text-center transition-colors bg-black text-white dark:bg-white dark:text-black">
                Länder
            </button>
            <button onclick="switchTab('movies')" id="tab-movies" class="tab-btn flex-1 min-w-[90px] py-4 px-2 border-r-2 border-black dark:border-white text-center transition-colors bg-transparent text-black dark:text-white">
                Filme
            </button>
            <button onclick="switchTab('celebs')" id="tab-celebs" class="tab-btn flex-1 min-w-[90px] py-4 px-2 border-r-2 border-black dark:border-white text-center transition-colors bg-transparent text-black dark:text-white">
                Promis
            </button>
            <button onclick="switchTab('sports')" id="tab-sports" class="tab-btn flex-1 min-w-[90px] py-4 px-2 border-r-2 border-black dark:border-white text-center transition-colors bg-transparent text-black dark:text-white">
                Sportler
            </button>
            <button onclick="switchTab('videogames')" id="tab-videogames" class="tab-btn flex-1 min-w-[90px] py-4 px-2 text-center transition-colors bg-transparent text-black dark:text-white">
                Spiele
            </button>
        </div>

        <x-scoreboard-table id="countries" :active="true">
            <tr class="bg-stone-100 dark:bg-stone-800">
                <td class="p-3 text-center border-r-2 border-black dark:border-white"><span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5 font-black">#1</span></td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">Arch_groesser_Cachy</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">1 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:14s</td>
                <td class="p-3 text-center">17.06.26</td>
            </tr>
            <tr>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">#2</td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white">BladeMaster</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">2 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:32s</td>
                <td class="p-3 text-center">16.06.26</td>
            </tr>
            <tr>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">#3</td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white">TailwindFan</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">4 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">1:05m</td>
                <td class="p-3 text-center">15.06.26</td>
            </tr>
        </x-scoreboard-table>

        <x-scoreboard-table id="movies">
            <tr class="bg-stone-100 dark:bg-stone-800">
                <td class="p-3 text-center border-r-2 border-black dark:border-white"><span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5 font-black">#1</span></td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">Cineast99</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">2 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:41s</td>
                <td class="p-3 text-center">17.06.26</td>
            </tr>
            <tr>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">#2</td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">Nolan_Bro</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">3 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:55s</td>
                <td class="p-3 text-center">14.06.26</td>
            </tr>
        </x-scoreboard-table>

        <x-scoreboard-table id="celebs">
            <tr class="bg-stone-100 dark:bg-stone-800">
                <td class="p-3 text-center border-r-2 border-black dark:border-white"><span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5 font-black">#1</span></td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">GossipGirl</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">1 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:08s</td>
                <td class="p-3 text-center">16.06.26</td>
            </tr>
        </x-scoreboard-table>

        <x-scoreboard-table id="sports">
            <tr class="bg-stone-100 dark:bg-stone-800">
                <td class="p-3 text-center border-r-2 border-black dark:border-white"><span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5 font-black">#1</span></td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">GOAT_10</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">2 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">0:22s</td>
                <td class="p-3 text-center">17.06.26</td>
            </tr>
        </x-scoreboard-table>

        <x-scoreboard-table id="videogames">
            <tr class="bg-stone-100 dark:bg-stone-800">
                <td class="p-3 text-center border-r-2 border-black dark:border-white"><span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5 font-black">#1</span></td>
                <td class="p-3 text-left border-r-2 border-black dark:border-white font-black">NoobSlayer</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">3 / 6</td>
                <td class="p-3 text-center border-r-2 border-black dark:border-white">1:12m</td>
                <td class="p-3 text-center">17.06.26</td>
            </tr>
        </x-scoreboard-table>

    </div>
    
    <x-return-home/>
    
</div>

<script>
    function switchTab(quizId) {
        // Alle Tabellen ausblenden
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        
        // Alle Buttons auf inaktiv setzen
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black');
            btn.classList.add('bg-transparent', 'text-black', 'dark:text-white');
        });

        // Gewähltes Panel einblenden
        document.getElementById('panel-' + quizId).classList.remove('hidden');

        // Gewählten Button einfärben (Invers-Brutalismus)
        const activeBtn = document.getElementById('tab-' + quizId);
        activeBtn.classList.remove('bg-transparent', 'text-black', 'dark:text-white');
        activeBtn.classList.add('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black');
    }
</script>

@endsection