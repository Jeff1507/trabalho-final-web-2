<nav x-data="{ open: false }" class="bg-zinc-800 border-b border-zinc-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-zinc-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-heroicon-m-home class="w-5 h-5 mr-2"/>
                        {{ __('Início') }}
                    </x-nav-link>
                    @can('hasFullPermission', App\Models\UserList::class)
                        <x-nav-link :href="route('movies-list.index')" :active="request()->routeIs('movies-list.index')">
                            <x-heroicon-c-film class="w-5 h-5 mr-2"/>
                            {{ __('Listas de filmes') }}
                        </x-nav-link>
                    @endcan
                    @can('hasModeratePermission', App\Models\Comment::class)
                        <x-nav-link :href="route('comment.reported')" :active="request()->routeIs('comment.reported')">
                            <x-heroicon-c-exclamation-triangle class="w-5 h-5 mr-2"/>
                            {{ __('Comentários reportados') }}
                        </x-nav-link>
                    @endcan
                    <x-nav-link :href="route('movie.search')" :active="request()->routeIs('movie.search')">
                        <x-heroicon-c-magnifying-glass class="w-5 h-5 mr-2"/>
                        {{ __('Buscar') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-200 bg-zinc-800 hover:text-[#D0BCFF] focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <x-heroicon-s-user-circle class="w-6 h-6"/>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-zinc-400 hover:bg-zinc-900 focus:outline-none focus:bg-zinc-900 focus:text-zinc-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Início') }}
            </x-responsive-nav-link>
            @can('hasFullPermission', App\Models\UserList::class)
                <x-responsive-nav-link :href="route('movies-list.index')" :active="request()->routeIs('movies-list.index')">
                    {{ __('Listas de filmes') }}
                </x-responsive-nav-link>
            @endcan
            @can('hasModeratePermission', App\Models\Comment::class)
                <x-responsive-nav-link :href="route('comment.reported')" :active="request()->routeIs('comment.reported')">
                    {{ __('Comentários reportados') }}
                </x-responsive-nav-link>
            @endcan
            <x-responsive-nav-link :href="route('movie.search')" :active="request()->routeIs('movie.search')">
                {{ __('Buscar') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-zinc-600">
            <div class="px-4">
                <div class="font-medium text-base text-zinc-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-zinc-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Sair') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
