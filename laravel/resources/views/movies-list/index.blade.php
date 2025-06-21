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
                    <div class="w-44 sm:w-64 rounded-2xl overflow-hidden border border-zinc-400 flex flex-col justify-center">
                        <div class="flex items-center justify-center w-full h-44 sm:h-64 overflow-hidden">
                            <!-- TODO: placeholder da imagem -->
                            <img class="w-full object-cover" src="{{ asset('storage/' . $user_list->img) }}" alt="Imagem da lista">
                        </div>
                        <div class="p-2 sm:p-4 w-full">
                            <h3 class="text-zinc-200 text-base sm:text-lg font-semibold tracking-wide line-clamp-1">
                                {{ $user_list->name }}
                            </h3>
                            <p class="text-zinc-400 text-xs sm:text-sm mb-4 sm:mb-8">
                                Criada {{ $user_list->created_at->diffForHumans() }}.
                            </p>
                            <x-button class="w-full rounded-xl">
                                Ver Completa
                            </x-button>
                            <!--
                            <div class="w-full flex items-center justify-between">
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