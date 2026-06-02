<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'w-full py-4 sm:py-5 bg-black text-white hover:bg-stone-800 font-black text-base tracking-wide uppercase transition-colors text-center cursor-pointer mt-8'
    ]) }}
>
    {{ $slot }}
</button>