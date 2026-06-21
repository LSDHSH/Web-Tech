@props(['title'])

<details class="group/section flex flex-col">
  <summary class="group p-6 bg-white dark:bg-stone-900 hover:bg-black dark:hover:bg-white text-black dark:text-white hover:text-white dark:hover:text-black transition-colors duration-150 flex justify-between items-center cursor-pointer select-none list-none font-black uppercase tracking-tight text-2xl md:text-3xl [::-webkit-details-marker]:hidden">
    <span>{{ $title }}</span>
    <span class="text-xl md:text-2xl font-black group-open/section:hidden">+</span>
    <span class="text-xl md:text-2xl font-black hidden group-open/section:inline">−</span>
  </summary>
  
  <div class="bg-stone-50 dark:bg-stone-800 border-t-4 border-black dark:border-white divide-y-2 divide-black dark:divide-white">
    {{ $slot }}
  </div>
</details>