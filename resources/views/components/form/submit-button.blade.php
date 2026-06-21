@props(
[
  'type' => 'button',
  'variant' => 'primary',
])

@php
$classes = match ($variant) {
  'secondary' => 'bg-white dark:bg-stone-900 text-black dark:text-white border-4 border-black dark:border-white hover:bg-stone-100 dark:hover:bg-stone-800',
  default => 'bg-black dark:bg-white text-white dark:text-black hover:bg-stone-800 dark:hover:bg-stone-200',
};
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "w-full py-4 sm:py-5 font-black text-base tracking-wide uppercase transition-colors text-center cursor-pointer {$classes}"]) }}>
  {{ $slot }}
</button>