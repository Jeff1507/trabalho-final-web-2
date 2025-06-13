@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm']) }}>