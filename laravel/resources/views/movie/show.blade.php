<x-app-layout>
    <section class="flex flex-col sm:flex-row items-center gap-4 sm:gap-8">
        @if ($movie['poster_path'])
            <img class="rounded-lg w-full sm:w-auto" src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
        @endif
        <div class="flex flex-col gap-4 w-full">
            <h2 class="text-xl sm:text-3xl text-zinc-200 font-bold tracking-wide">
                {{ $movie['title'] }}
            </h2>
            <div class="flex items-center gap-2">
                @foreach ($movie['genres'] as $genre)
                    <x-chip>
                        {{ $genre['name'] }}
                    </x-chip>
                @endforeach
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="text-base sm:text-xl text-zinc-200 font-semibold">
                    Sinopse
                </h3>
                <p class="text-xs sm:text-sm text-zinc-400">
                    @if ($movie['overview'])
                        {{ $movie['overview'] }}
                    @else
                        Nenhuma sinopse informada!
                    @endif
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-10 w-full">
                <div class="flex items-center gap-2">
                    <x-heroicon-c-calendar-date-range class="w-5 h-5 text-zinc-200" />
                    <p class="text-xs sm:text-sm text-zinc-400 font-semibold">
                        {{ date('Y', strtotime($movie['release_date'])) }}
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <x-heroicon-c-clock class="w-5 h-5 text-zinc-200" />
                    <p class="text-xs sm:text-sm text-zinc-400 font-semibold">
                        {{ $movie['runtime'] }} min
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <x-heroicon-c-user class="w-5 h-5 text-zinc-200" />
                    <p class="text-xs sm:text-sm text-zinc-400 font-semibold">
                        {{ $directors }}
                    </p>
                </div>
            </div>
            <div class="w-full mt-4">
                <x-button>
                    Adicionar a uma lista
                </x-button>
            </div>    
        </div>
    </section>
</x-app-layout>