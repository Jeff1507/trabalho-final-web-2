@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#D0BCFF] text-start text-base font-medium text-zinc-200 bg-[#381E72] focus:outline-none focus:text-[#E8DEF8] focus:bg-[#4A4458] focus:border-[#E8DEF8] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-zinc-400 hover:text-zinc-200 hover:bg-zinc-700 hover:border-zinc-600 focus:outline-none focus:text-zinc-200 focus:bg-zinc-700 focus:border-zinc-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>