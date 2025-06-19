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
    
    <div class="grid grid-cols-4 gap-4 mt-8">
        @foreach($movies as $movie)
            <div class="flex flex-col items-center p-4 border border-zinc-400">
                <div class="w-full h-64">
                    @if ($movie['poster_path'])
                        <img class="mx-auto h-full rounded-lg" src="https://image.tmdb.org/t/p/w300{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                    @endif
                </div>
                <h2 class="">
                    {{ $movie['title'] }}
                </h2>
            </div>
        @endforeach
    </div>
</x-app-layout>