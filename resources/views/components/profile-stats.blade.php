@props(['value', 'label'])

<div {{ $attributes->merge(['class' => 'p-6 bg-white dark:bg-stone-900 border-4 border-black dark:border-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] text-center']) }}>
    <span class="block text-4xl font-mono font-black mb-1">{{ $value }}</span>
    <span class="text-xs uppercase tracking-wider font-bold text-stone-500 dark:text-stone-400">{{ $label }}</span>
</div>