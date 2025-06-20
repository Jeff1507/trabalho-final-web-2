<x-app-layout>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col w-full gap-4 sm:gap-8">
        <h2 class="text-2xl sm:text-4xl text-zinc-200 font-bold tracking-wide">
            Nova Lista
        </h2>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
            <label for="img" class="aspect-square size-56 sm:size-80 border-2 border-dashed border-zinc-400 rounded-2xl flex items-center justify-center cursor-pointer overflow-hidden">
                <img id="preview" src="#" alt="Preview" class="hidden w-full object-cover"/>
                <div id="placeholder" class="w-full h-full flex flex-col gap-2 sm::gap-4 p-2 items-center justify-center">
                    <x-heroicon-o-camera class="w-12 h-12 sm:w-16 sm:h-16 text-[#D0BCFF]"/>
                    <p class="text-sm text-zinc-400 font-semibold text-center">
                        Clique aqui para enviar uma foto
                    </p>
                </div>
                <input class="hidden" type="file" name="img" id="img" accept="image/png, image/jpeg, image/jpg"/>
            </label>
            <div class="flex flex-col flex-1 gap-4">
                <div class="w-full flex flex-col space-y-1.5">
                    <x-input-label for="name" :value="__('Nome da lista')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex-1 flex flex-col space-y-1.5">
                    <x-input-label for="description" :value="__('Descrição (opcional)')"/>
                    <textarea 
                        class="border-zinc-400 bg-transparent text-white focus:border-[#D0BCFF] focus:ring-[#D0BCFF] rounded-sm shadow-sm h-full" 
                        name="description" 
                        id="description" 
                    ></textarea>
                </div>
                
            </div>
        </div>
        <div class="w-full flex items-center justify-end gap-4">
            <x-button type="button" variant="text" onclick="window.location.href='{{ route('movies-list.index') }}'">
                Cancelar
            </x-button>
            <x-button type="submit">
                Salvar
            </x-button>
        </div>
    </form>
    <script>
        document.getElementById('img').addEventListener('change', function (e) {
            const [file] = e.target.files;
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>