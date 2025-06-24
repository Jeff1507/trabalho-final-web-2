<x-app-layout>
    <section class="space-y-8">
        <x-title>
            Comentários reportados
        </x-title>
        @if ($comments->isEmpty())
            <x-not-found>
                Nada aqui!
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
                                Usuário
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora da criação
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora da denúncia
                            </th>
                            <th scope="col" class="px-2 py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr class="border-b border-zinc-400">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-zinc-200">
                                    {{ $comment->id }}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-s-user-circle class="w-8 h-8 text-zinc-200"/>
                                        <p class="text-zinc-200">
                                            {{ $comment->review->user->name }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $comment->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $comment->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-2 py-4">
                                    <button
                                        class="text-[#D0BCFF] text-sm font-medium cursor-pointer hover:underline"
                                        x-data="" 
                                        x-on:click.prevent="$dispatch('open-modal', 'remove-comment-{{ $comment->id }}')"
                                    >
                                        Ver Comentário
                                    </button>

                                    <x-modal name="remove-comment-{{ $comment->id }}" focusable maxWidth="lg">
                                        <div class="p-6 flex flex-col gap-4">
                                            <div class="flex flex-col gap-4">
                                                <div class="flex items-center gap-2">
                                                    <x-heroicon-s-user-circle class="w-14 h-14 text-zinc-200"/>
                                                    <p class="text-zinc-200">
                                                        {{ $comment->review->user->name }}
                                                    </p>
                                                </div>
                                                <p class="text-sm text-zinc-400">
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                            <form action="{{ route('comment.remove', $comment->id) }}" method="POST" class="w-full flex items-center justify-end gap-4">
                                                @csrf
                                                <x-button variant="text" type="button" x-on:click="$dispatch('close')">
                                                    Cancelar
                                                </x-button>
                                                <x-button type="submit">
                                                    Remover
                                                </x-button>
                                            </form>
                                        </div>
                                    </x-modal>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</x-app-layout>