<x-app-layout>
    <section class="flex items-start gap-8">
        @if ($movie['poster_path'])
            <img class="rounded-lg" src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
        @endif
        <div class="flex flex-col gap-6 w-full">
            <h2 class="text-3xl text-zinc-200 font-bold tracking-wide">
                {{ $movie['title'] }}
            </h2>
            <div class="flex items-center gap-4 font-bold">
                <p class="text-zinc-200 ">
                    {{ date('Y', strtotime($movie['release_date'])) }}
                </p>
                <hr class="w-px bg-zinc-200 min-h-4 h-full mx-2">
                @foreach ($movie['genres'] as $genre)
                    <p class="text-sm text-zinc-200">
                        {{ $genre['name'] }}
                    </p>
                @endforeach
            </div>
            <p class="text-sm text-zinc-200">
                {{ $movie['overview'] }}
            </p>
            <div class="w-full">
                <x-button>
                    Adicionar a uma lista
                </x-button>
            </div>    
        </div>
    </section>

</x-app-layout>