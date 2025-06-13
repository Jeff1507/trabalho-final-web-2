<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-zinc-100">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Deletar conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-zinc-200">
                {{ __('Tem certeza que deseja deletar sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-zinc-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6 w-full">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Senha') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button type="button" variant="text" x-on:click="$dispatch('close')">
                    {{ __('Voltar') }}
                </x-button>

                <x-danger-button class="ms-3">
                    {{ __('Deletar conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>