<x-app-layout>
    <section class="flex flex-col items-center justify-center gap-8">
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
                    <x-button>
                        <x-heroicon-m-plus class="w-5 h-5 mr-2"/>
                        Adicionar filmes
                    </x-button>
                    <x-button variant="tonal">
                        <x-heroicon-s-pencil class="w-5 h-5 mr-2"/>
                        Editar lista
                    </x-button>
                    <x-button class="bg-red-500 text-white hover:bg-red-600">
                        <x-heroicon-s-trash class="w-5 h-5 mr-2"/>
                        Excluir lista
                    </x-button>
                </div> 
            </div>
        </div>
        <div class="relative overflow-x-auto w-full">
            asadasdas
        </div>
    </section>
</x-app-layout>