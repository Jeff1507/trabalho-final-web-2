<x-app-layout>
    <section class="flex flex-col items-center justify-center gap-8">
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @elseif (session('error'))
            <x-alert type="error">
                {{ session('error') }}
            </x-alert>
        @endif
        <div class="w-full flex items-center gap-8">
            <div class="aspect-square bg-zinc-800 size-56 sm:size-80 flex items-center justify-center rounded-2xl overflow-hidden">
                @if($user_list->img)
                    <img class="w-full object-cover" src="{{ asset('storage/' . $user_list->img) }}" alt="Imagem da lista">
                @else
                    <div class="w-full h-full flex flex-col gap-2 sm::gap-4 p-2 items-center justify-center">
                        <x-heroicon-s-photo class="w-12 h-12 sm:w-16 sm:h-16 text-zinc-400"/>
                        <p class="text-sm text-zinc-400 font-semibold text-center">
                            Imagem não disponível
                        </p>
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-4 flex-1">
                <x-title>
                    {{ $user_list->name }}
                </x-title>
                <p class="text-xs sm:text-sm text-zinc-400">
                    @if($user_list->description)
                        {{ $user_list->description }}
                    @else
                        Nenhuma descrição informada!
                    @endif
                </p>
                <div class="flex flex-wrap items-center gap-10 w-full">
                    <div class="flex items-center gap-2">
                        <x-heroicon-c-calendar-date-range class="w-5 h-5 text-zinc-200" />
                        <p class="text-xs sm:text-sm text-zinc-400 font-semibold">
                            Criada {{ $user_list->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-heroicon-c-video-camera class="w-5 h-5 text-zinc-200" />
                        <p class="text-xs sm:text-sm text-zinc-400 font-semibold">
                            12 filmes
                        </p>
                    </div>
                </div>
                <div class="w-full flex items-center gap-4 mt-8">
                    <x-button onclick="window.location.href='{{ route('movie.search') }}'">
                        <x-heroicon-m-plus class="w-5 h-5 mr-2"/>
                        Adicionar filmes
                    </x-button>
                    <x-button variant="tonal" onclick="window.location.href='{{ route('movies-list.edit', $user_list->id) }}'">
                        <x-heroicon-s-pencil class="w-5 h-5 mr-2"/>
                        Editar lista
                    </x-button>
                    <x-button
                        type="button" 
                        x-data="" 
                        x-on:click.prevent="$dispatch('open-modal', 'delete-movies-list')"
                        class="bg-red-500 text-white hover:bg-red-600"
                    >
                        <x-heroicon-s-trash class="w-5 h-5 mr-2"/>
                        Excluir lista
                    </x-button>
                </div> 
            </div>
        </div>
        @if ($movies->isEmpty())
            <x-not-found>
                Lista vazia!
            </x-not-found>
        @else
            <div class="relative overflow-x-auto w-full">
                <table class="w-full text-sm text-left rtl:text-right text-zinc-400">
                    <thead class="text-base text-zinc-200 border-b border-zinc-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Filme
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ano de lançamento
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Duração
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Adicionado em
                            </th>
                            <th scope="col" class="py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr class="border-b border-zinc-400">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-zinc-200">
                                    {{ $movie->tmdb_id }}
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{ route('movie.show', $movie->tmdb_id) }}" class="flex items-center gap-2 group">
                                        <div class="aspect-square size-8 sm:size-12 flex items-center justify-center rounded-lg overflow-hidden">
                                            @if ($movie->poster_url)
                                                <img class="w-full object-cover" src="{{ asset('storage/' . $movie->poster_url) }}" alt="Poster do filme">
                                            @else
                                                <div class="w-full h-full flex bg-zinc-700 items-center justify-center">
                                                    <x-heroicon-s-photo class="w-5 h-5 text-zinc-400"/>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-zinc-200 group-hover:underline">
                                            {{ $movie->title }}
                                        </p>  
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $movie->release_year }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $movie->runtime }} min
                                </td>
                                <td class="px-6 py-4">
                                    {{ $movie->pivot->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-2 py-4">
                                    <button
                                        type="button" 
                                        x-data="" 
                                        x-on:click.prevent="$dispatch('open-modal', 'remove-movie-{{ $movie->id }}')"
                                    >
                                        <x-heroicon-s-trash class="w-5 h-5 text-red-500"/>
                                    </button>

                                    {{-- MODAL PARA REMOVER FILME DA LISTA --}}
                                    <x-modal name="remove-movie-{{ $movie->id }}" focusable maxWidth="lg">
                                        <div class="p-6 flex flex-col gap-4">
                                            <h2 class="text-2xl text-zinc-200 font-medium tracking-wide">
                                                Deseja remover esse filme da lista?
                                            </h2>
                                            <p class="text-sm text-zinc-400">
                                                Esta ação não poderá ser desfeita. Clique em <span class="font-bold">REMOVER</span> para confirmar.
                                            </p>
                                            <form method="POST" action="{{ route('movies-list.removeMovieFromList', [$user_list->id, $movie->id]) }}" class="mt-4 w-full flex gap-4 items-center justify-end">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="button" variant="text" x-on:click="$dispatch('close')">
                                                    Cancelar
                                                </x-button>
                                                <x-button type="submit">
                                                    Remover
                                                </x-button>
                                            </form>
                                        </div>
                                    </x-modal>
                                    {{--  --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    {{-- MODAL PARA DELETAR LISTA --}}
    <x-modal name="delete-movies-list" focusable maxWidth="lg">
        <div class="p-6 flex flex-col gap-4">
            <h2 class="text-2xl text-zinc-200 font-medium tracking-wide">
                Deseja excluir essa lista?
            </h2>
            <p class="text-sm text-zinc-400">
                Esta ação não poderá ser desfeita. Clique em <span class="font-bold">EXCLUIR</span> para confirmar.
            </p>
            <form method="POST" action="{{ route('movies-list.destroy', $user_list->id) }}" class="mt-4 w-full flex gap-4 items-center justify-end">
                @csrf
                @method('DELETE')
                <x-button type="button" variant="text" x-on:click="$dispatch('close')">
                    Cancelar
                </x-button>
                <x-button type="submit">
                    Excluir
                </x-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>