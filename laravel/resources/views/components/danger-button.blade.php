<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-600 h-10 px-6 flex gap-2 items-center justify-center text-xs sm:text-sm tracking-wide rounded-full font-medium cursor-pointer text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-zinc-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>