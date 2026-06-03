@props(['href', 'title'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group p-6 md:p-8 bg-white dark:bg-stone-900 hover:bg-black dark:hover:bg-white text-black dark:text-white hover:text-white dark:hover:text-black transition-colors duration-150 flex justify-between items-center']) }}>
    <span class="text-2xl md:text-3xl font-black uppercase tracking-tight">{{ $title }}</span>
    <span class="text-xl md:text-2xl font-black transform group-hover:translate-x-2 transition-transform">→</span>
</a>