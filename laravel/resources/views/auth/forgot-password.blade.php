<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-8">
        @csrf
        <div>
            <h1 class="text-2xl font-medium text-center text-white tracking-wider">
                Redefinir Senha
            </h1>
            <p class="text-sm text-center text-zinc-300">
                Digite seu email abaixo para recuperar sua conta.
            </p>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-button type="submit" class="w-full">
            {{ __('Enviar email de verificação') }}
        </x-button>
    </form>
</x-guest-layout>