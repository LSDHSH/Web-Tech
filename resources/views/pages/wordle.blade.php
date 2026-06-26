@extends('layouts.app')

@section('content')



<x-wordle.box>
  @if ($errors->any())
    <div class="mb-4 rounded-lg bg-rose-50 dark:bg-rose-950/30 p-4 text-sm font-medium text-rose-700 dark:text-rose-400 ring-1 ring-rose-600/10 dark:ring-rose-500/20">
      <ul class="list-disc pl-4 space-y-1">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </ul>
    </div>
  @endif
  <x-wordle.info :mode="$mode" :maxAttempts="$max_attempts" />
  <x-wordle.input :label="$label" :options="$options" />
  <x-wordle.table :headers="$headers" />
</x-wordle.box>

<script>
  document.addEventListener('DOMContentLoaded', () =>
  {
    const tableBody = document.getElementById('wordle-table-body');
    const placeholder = document.getElementById('table-placeholder');
    const attemptsSpan = document.getElementById('current-attempts');
    const maxAttemptsSpan = document.getElementById('max-attempts');
    const searchInput = document.getElementById('wordle-search');
    const guessBtn = document.getElementById('guess-btn');
    const feedbackContainer = document.getElementById('wordle-feedback');
    const currentMode = @json($mode); 
    const maxAttempts = maxAttemptsSpan ? parseInt(maxAttemptsSpan.textContent) : 8;
    const initialHistory = @json($history);
    const initialStatus = @json($game_status);
    const initialSolution = @json($solution); 
    
    function initGame()
    {
      if (initialHistory && initialHistory.length > 0)
      {
        if (placeholder) 
          placeholder.remove();
        
        initialHistory.forEach(row => renderRow(row));
        
        if (attemptsSpan) 
          attemptsSpan.textContent = initialHistory.length;
      }
      
      if (initialStatus === 'won' || initialStatus === 'lost')
      {
        disableGame();
        showEndscreen(initialStatus, initialSolution);
      }
    }
    
    document.addEventListener('wordle-submit', async (e) =>
    {
      let currentAttempts = attemptsSpan ? parseInt(attemptsSpan.textContent) : 0;
      
      if (currentAttempts >= maxAttempts)
      {
        disableGame();
        return;
      }
      
      const guessValue = e.detail.guess;
      await sendGuessToBackend(guessValue);
    });
    
    async function sendGuessToBackend(guessValue)
    {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      
      try
      {
        const response = await fetch(`/${currentMode}/wordle/guess`,
        {
          method: 'POST',
          headers:
          {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ guess: guessValue })
        });
        
        if (!response.ok)
        {
          const errorData = await response.json();
          throw new Error(errorData.error || 'An Error occured.');
        }
        
        const data = await response.json();
        
        if (placeholder)
          placeholder.remove();
        
        renderRow(data.results);
        
        if (attemptsSpan)
        {
          attemptsSpan.textContent = data.attempts;
        }
        
        if (data.status === 'won' || data.status === 'lost')
        {
          disableGame();
          setTimeout(() =>
          {
            showEndscreen(data.status, data.solution);
          }, 300);
        }
      } catch (error)
      {
        showValidationErrorMsg(error.message);
      }
    }
    
    function renderRow(results)
    {
      const tr = document.createElement('tr');
      tr.classList.add('font-bold', 'text-black', 'dark:text-white', 'divide-x-2', 'divide-black', 'dark:divide-white');
      
      results.forEach(column =>
      {
        const td = document.createElement('td');
        td.classList.add('p-3', 'text-center', 'align-middle', 'border-b-2', 'border-black', 'dark:border-white');
        
        if (column.status === 'correct')
          td.classList.add('bg-green-500', 'text-white');
        else if (column.status === 'partial' || column.status === 'higher' || column.status === 'lower')
          td.classList.add('bg-yellow-400', 'text-black');
        else if (column.status === 'wrong') 
          td.classList.add('bg-red-500', 'text-white');
        
        switch (column.type)
        {
          case 'array':
            const listContainer = document.createElement('div');
            listContainer.classList.add('flex', 'flex-col', 'gap-y-1', 'justify-center', 'items-center');
            
            column.value.forEach(item =>
            {
              const itemDiv = document.createElement('div');
              itemDiv.textContent = (typeof item === 'object' && item !== null) ? item.value : item;
              itemDiv.classList.add('w-full', 'text-center');
              listContainer.appendChild(itemDiv);
            });
            
            td.appendChild(listContainer);
          break;
          
          case 'number':
          case 'date_year':
          case 'count':
            td.classList.add('whitespace-nowrap');
            td.textContent = column.value;
            
            if (column.status === 'higher')
              td.textContent += ' ↑';
            
            if (column.status === 'lower')
              td.textContent += ' ↓';
          break;
          
          default:
            td.textContent = column.value;
          break;
        }
        
        tr.appendChild(td);
      });
      
      if (tableBody)
      {
        tableBody.appendChild(tr);
        tr.scrollIntoView({ behavior: 'smooth', block: 'end' });
      }
    }
    
    function showEndscreen(status, solution)
    {
      if (!feedbackContainer) 
        return;
      
      feedbackContainer.innerHTML = '';
      feedbackContainer.classList.remove('hidden');
      const box = document.createElement('div');
      box.className = 'p-6 border-4 border-black text-center font-mono uppercase tracking-wider font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]';
      
      if (status === 'won')
      {
        box.classList.add('bg-green-400', 'text-black');
        box.innerHTML =
        `
          <h3 class="text-xl sm:text-2xl mb-1">Win!</h3>
          <p class="text-xs sm:text-sm font-bold">You have successfully solved the Wordle for today!</p>
        `;
      } 
      else
      {
        box.classList.add('bg-red-400', 'text-black');
        box.innerHTML =
        `
          <h3 class="text-xl sm:text-2xl mb-1">Game Over</h3>
          <p class="text-xs sm:text-sm font-bold">All attempts exhausted. The solution was:</p>
          <div class="mt-2 inline-block bg-black text-white px-4 py-1 border-2 border-black font-mono text-base tracking-widest">
            ${solution || 'Unknown'}
          </div>
        `;
      }
      
      feedbackContainer.appendChild(box);
      
      setTimeout(() =>
      {
        feedbackContainer.classList.remove('opacity-0', 'translate-y-4');
        feedbackContainer.classList.add('opacity-100', 'translate-y-0');
        box.scrollIntoView({ behavior: 'smooth', block: 'end' });
      }, 50);
    }
    
    function disableGame()
    {
      if (searchInput) searchInput.disabled = true;
      if (guessBtn) guessBtn.disabled = true;
    }
    
    function showValidationErrorMsg(msg)
    {
      const errorField = document.getElementById('search-error');
      
      if (errorField)
      {
        errorField.textContent = msg;
        errorField.classList.remove('hidden');
      }
    }
    
    initGame();
  });
</script>
@endsection