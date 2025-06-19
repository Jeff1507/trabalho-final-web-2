<x-app-layout>
    <form action="{{ route('movie.search') }}" method="GET" class="w-full">
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <x-heroicon-s-magnifying-glass class="w-5 h-5 text-zinc-200"/>
            </div>
            <input 
                type="text"
                class="block w-full p-4 ps-10 text-sm text-zinc-200 border border-zinc-200 bg-transparent rounded-md focus:border-[#D0BCFF] focus:ring-[#D0BCFF]"
                name="query"
                placeholder="Pesquisar por filme"
                required
            />
        </div>
    </form>
    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-8 mt-8">
        @foreach($movies as $movie)
            <a href="{{ route('movie.show', $movie['id']) }}" class="space-y-2 group">
                <div class="h-64 sm:h-80">
                    @if ($movie['poster_path'])
                        <img class="mx-auto h-full rounded-lg" src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                    @else
                        <div class="mx-auto h-full border border-dashed border-zinc-400 p-2 rounded-lg flex flex-col gap-1 items-center justify-center text-zinc-400">
                            <x-heroicon-s-photo class="w-10 h-10 sm:w-16 sm:h-16"/>
                            <p class="text-sm text-center">
                                Imagem não disponível!
                            </p>
                        </div>
                    @endif
                </div>
                <h2 class="text-zinc-200 font-semibold text-base sm:text-lg text-center line-clamp-2 group-hover:text-[#D0BCFF] group-hover:underline">
                    {{ $movie['title'] }}
                </h2>
            </a>
        @endforeach
    </div>

    {{-- Paginação --}}
    <div class="mt-8 flex justify-center gap-4 sm:gap-8">
        @if($page > 1)
            <x-button variant="outlined">
                <a href="{{ route('movie.search', ['query' => $query, 'page' => $page - 1]) }}" class="flex items-center gap-2 justify-center">
                    <x-heroicon-o-arrow-small-left class="w-5 h-5"/>
                    Anterior
                </a>
            </x-button>
        @endif

        @if($page < $total_pages)
            <x-button variant="outlined">
                <a href="{{ route('movie.search', ['query' => $query, 'page' => $page + 1]) }}" class="flex items-center gap-2 justify-center">
                    Próxima
                    <x-heroicon-o-arrow-small-right class="w-5 h-5"/>
                </a>
            </x-button>
        @endif
    </div>
</x-app-layout>