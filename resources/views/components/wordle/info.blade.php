@props(['mode', 'maxAttempts' => 6])

<div class="p-4 sm:p-6 border-b-4 border-black dark:border-white bg-stone-50 dark:bg-stone-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 font-bold text-xs sm:text-sm uppercase tracking-wider text-black dark:text-white">
  <div>
    Mode: <span class="bg-black text-white dark:bg-white dark:text-black px-2 py-0.5">{{ $mode }}</span>
  </div>
  <div class="font-mono">
    Trys: <span id="current-attempts">0</span>/<span id="max-attempts">{{ $maxAttempts }}</span>
  </div>
</div>