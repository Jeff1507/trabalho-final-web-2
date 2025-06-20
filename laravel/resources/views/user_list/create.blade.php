<x-app-layout>
    <section class="flex flex-col w-full gap-8">
        <h2 class="text-4xl text-zinc-200 font-bold tracking-wide">
            Nova Lista
        </h2>
        <div class="flex gap-8">
            <div class="aspect-square size-96 flex flex-col space-y-1.5">
                <label for="img" class="flex flex-col items-center justify-center w-full h-full border-2 rounded-lg border-zinc-400 border-dashed cursor-pointer">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4">
                        <x-heroicon-o-camera class="w-12 h-12 mb-4 text-[#D0BCFF]"/>
                        <p class="mb-2 text-sm text-zinc-400 text-center font-semibold">
                            Clique aqui para enviar uma foto
                        </p>
                        <p id="list_img" class="text-sm text-zinc-200 mt-2 hidden"></p>
                    </div>
                    <input class="hidden" type="file" name="img" id="img" accept="application/pdf"/>
                </label>
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>
            <div class="flex flex-col flex-1 gap-4">
                <div class="w-full flex flex-col space-y-1.5">
                    <x-input-label for="name" :value="__('Nome da lista')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex-1 flex flex-col space-y-1.5">
                    <x-input-label for="descrição" :value="__('Descrição (opcional)')"/>
                    <textarea 
                        class="border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm" 
                        name="descrição" 
                        id="descrição" 
                        rows="8"
                    ></textarea>
                </div>
                
            </div>
        </div>
        <div class="w-full flex items-center justify-end gap-4">
                    <x-button variant="text">
                        Cancelar
                    </x-button>
                    <x-button>
                        Salvar
                    </x-button>
                </div>
    </section>
    <!--
    <section class="flex items-center justify-center">
        <form action="" class="w-full sm:w-[400px] shadow-sm sm:border border-[#49454F] flex flex-col gap-4 sm:gap-8 sm:p-8">
            @csrf
            <h2 class="text-lg sm:text-2xl font-bold text-zinc-200 tracking-wide">
                Criar lista de filmes
            </h2>
            <div class="w-full flex flex-col space-y-1.5">
                <label for="img" class="flex flex-col items-center justify-center w-full h-full border-2 border-zinc-400 border-dashed rounded-sm cursor-pointer">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4">
                        <x-heroicon-o-camera class="w-8 h-8 mb-4 text-[#D0BCFF]"/>
                        <p class="mb-2 text-sm text-zinc-400 text-center font-semibold">
                            Clique aqui para enviar uma foto
                        </p>
                        <p id="list_img" class="text-sm text-zinc-200 mt-2 hidden"></p>
                    </div>
                    <input class="hidden" type="file" name="img" id="img" accept="application/pdf"/>
                </label>
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>
            <div class="w-full flex flex-col space-y-1.5">
                <x-input-label for="name" :value="__('Nome da lista')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </form>        
    </section>
    <script>
        document.getElementById('img').addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name;
            const label = document.getElementById('list_img');
            label.textContent = fileName;
            label.classList.remove('hidden');
        });
    </script>


    <div class="w-full flex flex-col space-y-1.5">
                    <x-input-label for="isPublic" :value="__('Privacidade')" />
                    <select name="status" id="status" class="border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm">
                        <option value="true" class="bg-zinc-900">
                            Lista publica
                        </option>
                        <option value="false" class="bg-zinc-900">
                            Lista privada
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
    -->
</x-app-layout>