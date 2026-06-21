<div class="w-full max-w-3xl flex flex-col items-center gap-y-4">
  <div class="top-0 z-50 w-full flex justify-center py-3">
    <a href="/home" class="mt-2 inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black dark:hover:text-white font-bold transition-colors">
      ← Return back home
    </a>
  </div>
  
  <div class="w-full max-w-3xl bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)] overflow-hidden text-left flex flex-col">
    {{ $slot }}
  </div>
</div>