<x-app-layout>
    <section class="space-y-4 sm:space-y-8">
        @if ($user_lists->isEmpty())
            <x-not-found>
                Nenhuma lista criada!
                <x-button onclick="window.location.href='{{ route('movies-list.create') }}'">
                    Criar nova lista
                </x-button>
            </x-not-found>
        @else
            @if (session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @elseif (session('error'))
                <x-alert type="error">
                    {{ session('error') }}
                </x-alert>
            @endif
            <div class="flex items-center justify-between">
                <x-title>
                    Suas listas
                </x-title>
                <x-button variant="text" onclick="window.location.href='{{ route('movies-list.create') }}'">
                    Criar nova lista
                </x-button>
            </div>
            <div class="w-full grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-4 place-items-center">
                @foreach ($user_lists as $user_list)
                    <div class="w-44 sm:w-64 rounded-2xl overflow-hidden bg-zinc-800 flex flex-col justify-center">
                        <div class="flex items-center justify-center w-full h-44 sm:h-64 overflow-hidden">
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
                        <div class="p-2 sm:p-4 w-full">
                            <h3 class="text-zinc-200 text-base sm:text-lg font-semibold tracking-wide line-clamp-1">
                                {{ $user_list->name }}
                            </h3>
                            <p class="text-zinc-400 text-sm sm:text-base mb-4 sm:mb-8">
                                12 filmes
                            </p>
                            <x-button class="w-full rounded-xl" onclick="window.location.href='{{ route('movies-list.show', $user_list->id) }}'">
                                Ver lista completa
                            </x-button>
                            <!--
                            <div class="w-full flex items-center justify-between">
                                Criada {{ $user_list->created_at->diffForHumans() }}.
                                <p class="text-zinc-200 text-xs sm:text-sm flex-1">
                                    103 items
                                </p>
                                <x-button class="rounded-xl">
                                    Ver Completa
                                </x-button>
                            </div>
                            -->
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-app-layout>