<x-app-layout>
    @if (session('success'))
        <x-alert type="success" class="mb-8">
            {{ session('success') }}
        </x-alert>
    @elseif (session('error'))
        <x-alert type="error" class="mb-8">
            {{ session('error') }}
        </x-alert>
    @endif
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
            @can('hasAddToListPermission', App\Models\Movie::class)
                <div class="w-full flex items-center gap-4 mt-4">
                    <x-button type="button" 
                        x-data="" 
                        x-on:click.prevent="$dispatch('open-modal', 'add-movie')"
                    >
                        Adicionar a uma lista
                    </x-button>
                    @if (!$reviews->contains('user_id', auth()->user()->id))
                        @can('hasFullPermission', App\Models\Review::class)
                            <x-button 
                                variant="tonal"
                                type="button" 
                                x-data="" 
                                x-on:click.prevent="$dispatch('open-modal', 'add-review')"
                            >
                                Avaliar esse filme
                            </x-button>
                        @endcan
                    @endif
                </div>    
            @endcan
        </div>
    </section>
    <section class="flex flex-col mt-32">
        @if ($reviews->isEmpty())
            <x-not-found>
                Nenhuma avaliação feita!
            </x-not-found>
        @else
            <x-title>
                Avaliações
            </x-title>
            <hr class="mt-8 h-px w-full border-zinc-400">
            @foreach ($reviews as $review)
                <div class="flex gap-4 border-b border-zinc-400 py-8">
                    <x-heroicon-s-user-circle class="w-14 h-14 text-zinc-200"/>
                    <div class="flex flex-col gap-1 flex-1">
                        <div class="w-full flex items-center justify-between">
                            <p class="text-zinc-200 text-sm font-medium">
                                {{ $review->user->name }}
                            </p>
                            <p class="text-zinc-400 text-sm">
                                {{ $review->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <x-heroicon-c-star class="w-4 h-4 text-yellow-400" />
                                @else
                                    <x-heroicon-c-star class="w-4 h-4 text-zinc-400" />
                                @endif
                            @endfor
                        </div>
                        <p class="text-sm text-zinc-400 mt-4">
                            @if ($review->comment)
                                @if ($review->comment->isRemoved == true)
                                    Comentário removido pela moderação!
                                @else
                                    {{ $review->comment->content }}
                                @endif
                            @else
                                Nenhum comentario adicionado!
                            @endif
                        </p>

                        {{-- ACOES POR ROLE --}}
                        @if ($review->comment)
                            @can('hasReportPermission', App\Models\Comment::class)
                                @if ($review->user->id !== auth()->user()->id && $review->comment->isRemoved == false)
                                    <button 
                                        class="mt-4 flex w-max text-red-500 items-center gap-2 justify-center"
                                        type="button" 
                                        x-data="" 
                                        x-on:click.prevent="$dispatch('open-modal', 'report-comment-{{ $review->comment->id }}')"
                                    >
                                        <x-heroicon-c-exclamation-triangle class="w-5 h-5"/>
                                        <p class="text-sm">
                                            Reportar
                                        </p>
                                    </button>
                                @endif
                            @endcan

                            @can('hasModeratePermission', App\Models\Comment::class)
                                @if ($review->comment && !$review->comment->isRemoved)
                                    <button 
                                        class="mt-4 flex w-max text-red-500 items-center gap-2 justify-center"
                                        type="button" 
                                        x-data="" 
                                        x-on:click.prevent="$dispatch('open-modal', 'remove-comment-{{ $review->comment->id }}')"
                                    >
                                        <x-heroicon-s-trash class="w-5 h-5"/>
                                        <p class="text-sm">
                                            Remover
                                        </p>
                                    </button>
                                @endif
                            @endcan
                        @endif
                        {{--  --}}
                    </div>
                </div>

                {{-- MODAL PARA REPORTAR COMENTARIOS --}}
                @if ($review->comment)
                    <x-modal name="report-comment-{{ $review->comment->id }}" focusable maxWidth="lg">
                        <div class="p-6 flex flex-col gap-4">
                            <h2 class="text-2xl text-zinc-200 font-medium tracking-wide">
                                Deseja reportar esse comentário?
                            </h2>
                            <p class="text-sm text-zinc-400">
                                Esse comentário será enviado para moderação julgar se será ou não removido das avaliações.
                            </p>
                            <form action="{{ route('comment.report', $review->comment->id) }}" method="POST" class="w-full flex items-center justify-end gap-4">
                                @csrf
                                <x-button variant="text" type="button" x-on:click="$dispatch('close')">
                                    Voltar
                                </x-button>
                                <x-button type="submit">
                                    Reportar
                                </x-button>
                            </form>
                        </div>
                    </x-modal>
                @endif
                {{--  --}}

                {{-- MODAL PARA REMOVER COMENTARIOS --}}
                @if ($review->comment)
                    <x-modal name="remove-comment-{{ $review->comment->id }}" focusable maxWidth="lg">
                        <div class="p-6 flex flex-col gap-4">
                            <h2 class="text-2xl text-zinc-200 font-medium tracking-wide">
                                Deseja remover esse comentário?
                            </h2>
                            <p class="text-sm text-zinc-400">
                                Esse comentário não será mais mostrado da seção de avaliações.
                            </p>
                            <form action="{{ route('comment.remove', $review->comment->id) }}" method="POST" class="w-full flex items-center justify-end gap-4">
                                @csrf
                                <x-button variant="text" type="button" x-on:click="$dispatch('close')">
                                    Voltar
                                </x-button>
                                <x-button type="submit">
                                    Remover
                                </x-button>
                            </form>
                        </div>
                    </x-modal>
                @endif
                {{--  --}}
            @endforeach
        @endif
        

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

                            <div class="aspect-square size-12 sm:size-16 flex items-center justify-center rounded-lg overflow-hidden">
                                @if ($user_list->img)
                                    <img class="w-full object-cover" src="{{ asset('storage/' . $user_list->img) }}" alt="Imagem da lista">
                                @else
                                    <div class="w-full h-full flex bg-zinc-700 items-center justify-center">
                                        <x-heroicon-s-photo class="w-5 h-5 text-zinc-400"/>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 flex items-center gap-2 justify-between">
                                <h3 class="text-sm text-zinc-200 font-bold line-clamp-2 flex-1">
                                    {{ $user_list->name }}
                                </h3>
                                @if ($user_list->movies->contains('tmdb_id', $movie['id']))
                                    <p class="flex items-center gap-2 text-sm text-green-500 font-semibold">
                                        Salvo
                                        <x-heroicon-m-check-circle class="w-6 h-6 text-green-500"/>
                                    </p>
                                @else
                                    <x-button class="h-8 w-1/3" variant="tonal" type="submit">
                                        Salvar
                                    </x-button>
                                @endif
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

        {{-- MODAL PARA ADICIONAR REVIEW --}}
        <x-modal name="add-review" focusable maxWidth="lg">
            <form action="{{ route('review.store') }}" method="POST" class="flex flex-col items-center justify-center gap-4 p-8" x-data="{ rating: 0 }">
                @csrf
                <x-heroicon-s-user-circle class="w-16 h-16 text-zinc-200"/>

                <h3 class="text-lg text-zinc-200 font-medium">
                    O que você achou do filme?
                </h3>

                <div class="flex items-center gap-1">
                    <template x-for="i in 5" :key="i">
                        <svg 
                            @click="rating = i" 
                            :class="i <= rating ? 'text-yellow-400' : 'text-zinc-400'" 
                            class="w-8 h-8 cursor-pointer transition-colors duration-200 fill-current"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.538 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.783.57-1.838-.197-1.538-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z"/>
                        </svg>
                    </template>
                </div>

                <input type="hidden" name="rating" x-ref="input" :value="rating">
                <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">

                <textarea
                    class="border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm w-full my-4 h-48" 
                    name="content" 
                    id="content"
                    placeholder="Escreva um comentário..."
                ></textarea>

                <div class="w-full flex items-center justify-end gap-4">
                    <x-button variant="text" type="button" x-on:click="$dispatch('close')">
                        Voltar
                    </x-button>
                    <x-button type="submit">
                        Publicar
                    </x-button>
                </div>

            </form>
        </x-modal>
    </section>
</x-app-layout>