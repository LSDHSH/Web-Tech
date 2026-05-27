@extends('layouts.app')

@section('content')
<div class="text-center w-[600px] mb-8 shrink-0">
    <h1 class="text-7xl font-black tracking-tighter uppercase mb-2">
        Guessle
    </h1>
    <a href="/index" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black font-bold transition-colors mb-4">
        ← Zurück zur Startseite
    </a>
</div>

<div class="w-[600px] bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden text-left flex flex-col">
    
    <div class="p-6 border-b-4 border-black bg-stone-50 flex justify-between items-center font-bold text-sm uppercase tracking-wider">
        <div>Modus: <span class="bg-black text-white px-2 py-0.5">Länder-Demo</span></div>
        <div id="try-counter">Versuche: 0/6</div>
    </div>

    <div class="p-8 border-b-4 border-black bg-white">
        <label for="country-input" class="block text-sm uppercase font-black tracking-wider mb-3">Welches Land wird gesucht?</label>
        
        <div class="flex gap-3">
            <input type="text" id="country-input" list="countries" autocomplete="off"
                class="flex-1 p-4 bg-white border-4 border-black text-black font-mono text-lg focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                placeholder="Land eingeben (z.B. Japan, Frankreich...)">
            
            <button id="guess-btn" onclick="makeGuess()" 
                class="px-8 bg-black text-white hover:bg-stone-800 font-black text-lg tracking-wide uppercase transition-colors cursor-pointer">
                Rate!
            </button>
        </div>

        <datalist id="countries">
            <option value="Deutschland">
            <option value="Frankreich">
            <option value="Japan">
            <option value="Kanada">
            <option value="Brasilien">
            <option value="Ägypten">
        </datalist>
    </div>

    <div class="p-6 bg-stone-50 overflow-x-auto min-h-[250px]">
        <table class="w-full text-center font-mono text-xs uppercase tracking-wider border-collapse">
            <thead>
                <tr class="border-b-2 border-black font-black text-stone-600">
                    <th class="pb-3 text-left">Land</th>
                    <th class="pb-3">Kontinent</th>
                    <th class="pb-3">Hauptstadt</th>
                    <th class="pb-3">Einwohner</th>
                    <th class="pb-3">Währung</th>
                </tr>
            </thead>
            <tbody id="results-table" class="divide-y-2 divide-stone-200">
            </tbody>
        </table>
        
        <div id="game-status" class="mt-8 text-center hidden">
            <h2 id="status-title" class="text-3xl font-black uppercase tracking-tighter mb-4"></h2>
            <p id="status-text" class="text-sm font-bold text-stone-500 mb-4"></p>
            <a href="/register" class="inline-block py-4 px-8 bg-black text-white font-black text-base uppercase tracking-wider hover:bg-stone-800 transition-colors">
                Jetzt registrieren & alle Modi freischalten →
            </a>
        </div>
    </div>
</div>

<script>
    const secretCountry = { name: "Japan", continent: "Asien", capital: "Tokio", pop: 125, currency: "Yen" };
    
    const countryDatabase = {
        "deutschland": { name: "Deutschland", continent: "Europa", capital: "Berlin", pop: 84, currency: "Euro" },
        "frankreich":  { name: "Frankreich", continent: "Paris", capital: "Paris", pop: 68, currency: "Euro" },
        "japan":       { name: "Japan", continent: "Asien", capital: "Tokio", pop: 125, currency: "Yen" },
        "kanada":      { name: "Kanada", continent: "Nordamerika", capital: "Ottawa", pop: 38, currency: "Dollar" },
        "brasilien":   { name: "Brasilien", continent: "Südamerika", capital: "Brasília", pop: 214, currency: "Real" },
        "ägypten":     { name: "Ägypten", continent: "Afrika", capital: "Kairo", pop: 110, currency: "Pfund" }
    };

    let attempts = 0;
    const maxAttempts = 6;
    let gameOver = false;

    function makeGuess() {
        if (gameOver) return;

        const inputEl = document.getElementById('country-input');
        const guessName = inputEl.value.trim().toLowerCase();
        
        if (!countryDatabase[guessName]) {
            alert("Bitte wähle ein Land aus der Liste (z.B. Japan, Deutschland, Frankreich...)");
            return;
        }

        attempts++;
        document.getElementById('try-counter').innerText = `Versuche: ${attempts}/${maxAttempts}`;
        
        const guess = countryDatabase[guessName];
        const tableBody = document.getElementById('results-table');

        const cContinent = guess.continent === secretCountry.continent ? 'bg-black text-white font-black' : 'bg-stone-200 text-stone-500 line-through';
        const cCapital   = guess.capital === secretCountry.capital ? 'bg-black text-white font-black' : 'bg-stone-200 text-stone-500 line-through';
        const cCurrency  = guess.currency === secretCountry.currency ? 'bg-black text-white font-black' : 'bg-stone-200 text-stone-500 line-through';
        
        let popArrow = "";
        let cPop = 'bg-stone-200 text-stone-500';
        if (guess.pop === secretCountry.pop) {
            cPop = 'bg-black text-white font-black';
        } else if (guess.pop < secretCountry.pop) {
            popArrow = " ↑";
        } else {
            popArrow = " ↓";
        }

        const row = document.createElement('tr');
        row.className = "font-bold";
        row.innerHTML = `
            <td class="py-4 text-left font-black">${guess.name}</td>
            <td class="py-4 px-1"><div class="p-2 border border-black ${cContinent}">${guess.continent}</div></td>
            <td class="py-4 px-1"><div class="p-2 border border-black ${cCapital}">${guess.capital}</div></td>
            <td class="py-4 px-1"><div class="p-2 border border-black ${cPop}">${guess.pop}M${popArrow}</div></td>
            <td class="py-4 px-1"><div class="p-2 border border-black ${cCurrency}">${guess.currency}</div></td>
        `;
        
        tableBody.insertBefore(row, tableBody.firstChild);
        inputEl.value = "";

        if (guess.name === secretCountry.name) {
            endGame(true, "Gewonnen!", `Du hast das geheime Land in ${attempts} Versuchen erraten!`);
        } else if (attempts >= maxAttempts) {
            endGame(false, "Schade!", `Das gesuchte Land war ${secretCountry.name}.`);
        }
    }

    function endGame(win, title, message) {
        gameOver = true;
        document.getElementById('country-input').disabled = true;
        document.getElementById('guess-btn').disabled = true;
        
        const statusDiv = document.getElementById('game-status');
        document.getElementById('status-title').innerText = title;
        document.getElementById('status-text').innerText = message;
        statusDiv.classList.remove('hidden');
    }
</script>
@endsection