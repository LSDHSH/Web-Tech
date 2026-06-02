<!--Wenn nichts angegeben ist, hat der Button Typ button und sieht aus wie primary Button -->
@props([
    'type' => 'button',
    'variant' => 'primary',
])
<!--Wenn variante "secondary" benutzt -> weißer Button -->
@php
$classes = match ($variant) {
    'secondary' => 'bg-white text-black border-4 border-black hover:bg-stone-100',
    default => 'bg-black text-white hover:bg-stone-800',
};
@endphp
<!--Erzeugt den Button -->
<button type="{{ $type }}" {{ $attributes->merge(['class' => "w-full py-4 sm:py-5 font-black text-base tracking-wide uppercase transition-colors text-center cursor-pointer {$classes}"]) }}>
    {{ $slot }}
</button>