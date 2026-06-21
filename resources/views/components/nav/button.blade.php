@props(['href' => null])

@if($href)
  <a href="{{ $href }}" {{ $attributes->merge(['class' => 'p-3 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none flex items-center gap-2 font-black uppercase tracking-wider text-sm transition-all cursor-pointer shrink-0']) }}>
    {{ $slot }}
  </a>
@else
  <button {{ $attributes->merge(['class' => 'p-3 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none flex items-center gap-2 font-black uppercase tracking-wider text-sm transition-all cursor-pointer shrink-0']) }}>
    {{ $slot }}
  </button>
@endif