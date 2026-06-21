@props(['active' => 'login'])

<div class="text-center w-full max-w-2xl mb-8">
  <a href="/" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-bold transition-colors">
    ← Back to Guessle
  </a>
</div>

<div class="w-full max-w-2xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
  
  <div class="flex flex-col sm:flex-row select-none shrink-0 text-lg border-b-4 border-black dark:border-white">
    
    {{-- Log In Tab --}}
    <a href="/login" class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase transition-colors sm:border-r-4 border-black dark:border-white {{ $active === 'login' ? 'bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200' : 'bg-stone-50 dark:bg-stone-850 text-stone-400 dark:text-stone-500 hover:text-black dark:hover:text-white hover:bg-stone-100 dark:hover:bg-stone-800' }}">
      Log in
    </a>
    
    {{-- Sign Up Tab --}}
    <a href="/register" class="w-full sm:w-1/2 py-3 sm:py-4 text-center font-black uppercase transition-colors {{ $active === 'register' ? 'bg-stone-100 dark:bg-stone-800 text-stone-800 dark:text-stone-200' : 'bg-stone-50 dark:bg-stone-850 text-stone-400 dark:text-stone-500 hover:text-black dark:hover:text-white hover:bg-stone-100 dark:hover:bg-stone-800' }}">
      Sign up
    </a>
    
  </div>
  
  {{ $slot }}
</div>
