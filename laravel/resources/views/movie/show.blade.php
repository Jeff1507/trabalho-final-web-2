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
                <x-button type="button" 
                    x-data="" 
                    x-on:click.prevent="$dispatch('open-modal', 'add-movie')"
                >
                    Adicionar a uma lista
                </x-button>
            </div>    
        </div>
    </section>
    <div class="w-full my-16">
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @elseif (session('error'))
            <x-alert type="error">
                {{ session('error') }}
            </x-alert>
        @endif
    </div>
    <section class="flex flex-col gap-12">
        <h2 class="text-xl sm:text-3xl text-zinc-200 font-bold tracking-wide">
            Avaliações
        </h2>
        @foreach ($reviews as $review)
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <x-heroicon-s-user-circle class="w-14 h-14 text-zinc-200"/>
                    <div class="flex-1 flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="text-zinc-200 text-sm font-semibold">
                                {{ $review->user->name }}
                            </p>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <x-heroicon-c-star class="w-2.5 h-2.5 text-yellow-400" />
                                        @else
                                            <x-heroicon-c-star class="w-2.5 h-2.5 text-zinc-400" />
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-zinc-400 text-sm">
                            {{ $review->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                <p class="text-sm text-zinc-400">
                    Nenhum comentario adicionado!
                </p>
            </div>
        @endforeach

        {{-- MODAL PARA MOSTRAR AS LISTAS --}}
        <x-modal name="add-movie" focusable maxWidth="lg">
            <div class="p-4 sm:p-6 flex flex-col gap-6 sm:gap-8">
                <h2 class="text-xl sm:text-3xl text-zinc-200 font-medium tracking-wide">
                    Escolha uma lista
                </h2>
                <div class="w-full space-y-2 max-h-[500px] overflow-y-auto">
                    @foreach ($user_lists as $user_list)
                        <form action="{{ route('movie.addToList') }}" method="POST" class="flex gap-4 p-2 max-h-20">
                            @csrf
                            {{-- CAMPOS QUE SERAO SALVOS --}}
                            <input type="hidden" name="user_list_id" value="{{ $user_list->id }}">
                            <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">
                            <input type="hidden" name="poster_url" value="{{ $movie['poster_path'] }}">
                            <input type="hidden" name="release_year" value="{{ $movie['release_date'] }}">
                            <input type="hidden" name="runtime" value="{{ $movie['runtime'] }}">
                            <input type="hidden" name="overview" value="{{ $movie['overview'] }}">
                            {{--  --}}

                            <div class="aspect-square bg-zinc-800 size-12 sm:size-16 flex items-center justify-center rounded-lg overflow-hidden">
                                <img class="w-full object-cover" src="{{ asset('storage/' . $user_list->img) }}" alt="Imagem da lista">

                            </div>
                            <div class="flex-1 flex items-center gap-2 justify-between">
                                <h3 class="text-sm text-zinc-200 font-bold line-clamp-2 flex-1">
                                    {{ $user_list->name }}
                                </h3>
                                <x-button class="h-8 w-1/3" variant="tonal" type="submit">
                                    Salvar
                                </x-button>
                            </div>
                        </form>
                    @endforeach
                </div>
                <div class="w-full flex items-center justify-end">
                    <x-button x-on:click="$dispatch('close')">
                        Concluido
                    </x-button>
                </div>
            </div>
        </x-modal>
    </section>
</x-app-layout>