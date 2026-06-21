@props(['href', 'hoverBg' => 'hover:bg-emerald-400 dark:hover:bg-emerald-500'])

<a href="{{ $href }}" class="group p-4 pl-10 {{ $hoverBg }} text-black dark:text-white hover:text-black transition-colors duration-150 flex justify-between items-center">
  <span class="text-base font-black uppercase tracking-tight">
    ➔ {{ $slot }}
  </span>
</a>