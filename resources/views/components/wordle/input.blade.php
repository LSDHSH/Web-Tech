@props(['label', 'options' => []])

<div class="p-4 sm:p-8 border-b-4 border-black dark:border-white bg-white dark:bg-stone-900">
  <label for="wordle-search" class="block text-sm uppercase font-black tracking-wider mb-3 text-black dark:text-white">
    Choose a {{ $label }}
  </label>
  
  <div class="flex flex-col sm:flex-row gap-3 relative">
    <div class="relative flex-1">
      <input type="text"
        id="wordle-search"
        autocomplete="off"
        placeholder="Type to search..."
        class="w-full p-3 sm:p-4 bg-white dark:bg-stone-900 border-4 border-black dark:border-white text-black dark:text-white font-mono text-base sm:text-lg focus:outline-none focus:bg-stone-50 dark:focus:bg-stone-800 placeholder-stone-400 font-bold transition-all duration-100"
      >
      
      <div id="dropdown-list" class="hidden absolute left-0 right-0 top-full mt-2 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] max-h-60 overflow-y-auto z-50 divide-y-2 divide-black dark:divide-white">
      </div>
    </div>
    <button id="guess-btn" class="px-6 sm:px-8 py-3 sm:py-0 bg-black text-white dark:bg-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200 font-black text-base sm:text-lg tracking-wide uppercase transition-colors cursor-pointer border-4 sm:border-0 border-black dark:border-white shrink-0">
      Guess!
    </button>
  </div>
  
  <p id="search-error" class="hidden text-red-500 font-mono font-bold text-xs uppercase tracking-wider mt-2">
    Please select a valid entry from the list!
  </p>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () =>
  {
    const searchInput = document.getElementById('wordle-search');
    const dropdownList = document.getElementById('dropdown-list');
    const guessBtn = document.getElementById('guess-btn');
    const errorMsg = document.getElementById('search-error');
    const allOptions = @json($options);
    const allowedOptionsUpper = typeof allOptions === 'object' ? Object.values(allOptions).map(o => o.trim().toUpperCase()) : [];
    
    searchInput.addEventListener('input', () =>
    {
      clearError();
      const filter = searchInput.value.toUpperCase().trim();
      
      if (filter.length < 1)
      {
        dropdownList.classList.add('hidden');
        return;
      }
      
      const matches = Object.values(allOptions).filter(option => 
        option.toUpperCase().includes(filter)
      ).slice(0, 6);
      
      if (matches.length > 0)
      {
        dropdownList.innerHTML = '';
        matches.forEach(match =>
        {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'w-full text-left p-3 font-mono font-bold text-sm bg-white dark:bg-stone-900 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors uppercase tracking-wider text-black dark:text-white cursor-pointer block';
          btn.textContent = match;
          
          btn.addEventListener('click', () =>
          {
            searchInput.value = match;
            dropdownList.classList.add('hidden');
            clearError();
          });
          dropdownList.appendChild(btn);
        });
        
        dropdownList.classList.remove('hidden');
      } 
      else
        dropdownList.classList.add('hidden');
    });
    
    document.addEventListener('click', (e) =>
    {
      if (!searchInput.contains(e.target) && !dropdownList.contains(e.target))
        dropdownList.classList.add('hidden');
    });
    
    function validateAndSubmit()
    {
      const rawValue = searchInput.value.trim();
      const currentValue = rawValue.toUpperCase();
      
      if (!allowedOptionsUpper.includes(currentValue) || currentValue === '')
      {
        showValidationError();
        return;
      }
      
      const event = new CustomEvent('wordle-submit',
      {
        detail: { guess: rawValue }
      });
      
      document.dispatchEvent(event);
      searchInput.value = '';
      dropdownList.classList.add('hidden');
    }
    
    function showValidationError()
    {
      errorMsg.classList.remove('hidden');
      searchInput.classList.add('border-red-500', 'dark:border-red-500', 'animate-brutal-shake');
      searchInput.classList.remove('border-black', 'dark:border-white');
      setTimeout(() => searchInput.classList.remove('animate-brutal-shake'), 200);
    }
    
    function clearError()
    {
      errorMsg.classList.add('hidden');
      searchInput.classList.remove('border-red-500', 'dark:border-red-500');
      searchInput.classList.add('border-black', 'dark:border-white');
    }
    
    guessBtn.addEventListener('click', validateAndSubmit);
    searchInput.addEventListener('keydown', (e) =>
    {
      if (e.key === 'Enter')
        {
        e.preventDefault();
        validateAndSubmit();
      }
    });
  });
</script>