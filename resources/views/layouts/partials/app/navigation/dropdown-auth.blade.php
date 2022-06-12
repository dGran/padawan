<x-dropdown align="right" width="max" class="relative">
    <x-slot name="trigger">
        <button
            class="border-2 border-border-color dark:border-dt-border-color | rounded-full | hover:border-edblue-400 dark:hover:border-edblue-300 | focus:outline-none focus:border-edblue-400 dark:focus:border-edblue-300 | text-dt-text-color dark:text-text-color | hover:text-dt-title-color dark:hover:text-title-color | focus:outline-none focus:text-dt-title-color dark:focus:text-title-color">
            <div
                class="flex items-center text-sm | rounded-full | h-8 w-8 md:h-9 md:w-9 m-0.5 | bg-text-color dark:bg-dt-text-color">
                <img src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user() . " avatar" }}"
                     class="rounded-full | object-cover | w-full h-auto">
            </div>
        </button>
        @if (auth()->user()->countTotalNotifications())
            <div class="absolute bottom-0 right-0 | mr-0.5 mb-1 md:-mr-0.5">
            <span class="flex h-3 w-3 md:h-4 md:w-4">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 dark:bg-red-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 md:h-4 md:w-4 bg-red-500 dark:bg-red-400"></span>
            </span>
            </div>
        @endif
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('account')">
            <div class="flex items-center space-x-2.5">
                <i class="fas fa-id-badge w-4"></i>
                <span>{{ __('Perfil') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('notifications')">
            <div class="flex items-center space-x-2.5 relative">
                <i class="fas fa-bell w-4 {{ !auth()->user()->countNotifications() ?: 'text-yellow-500 dark:text-yellow-400' }}"></i>
                <div class="flex items-center space-x-1.5">
                    @if (auth()->user()->countNotifications())
                        <span class="text-yellow-500 dark:text-yellow-400 font-bold">
                            ({{ auth()->user()->countNotifications() < 9 ? auth()->user()->countNotifications() : '+9' }})
                        </span>
                    @endif
                    <span
                        class="{{ !auth()->user()->countNotifications()?: 'text-yellow-500 dark:text-yellow-400' }}">{{ __('Notificaciones') }}</span>
                </div>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('myteams')">
            <div class="flex items-center space-x-2.5 relative">
                <i class="fa solid fa-user-shield w-4 {{ !auth()->user()->countEteamsNotifications() ?: 'text-yellow-500 dark:text-yellow-400' }}"></i>
                <div class="flex items-center space-x-1.5">
                    @if (auth()->user()->countEteamsNotifications())
                        <span class="text-yellow-500 dark:text-yellow-400 font-bold">
                            ({{ auth()->user()->countEteamsNotifications() < 9 ? auth()->user()->countEteamsNotifications() : '+9' }})
                        </span>
                    @endif
                    <span
                        class="{{ !auth()->user()->countEteamsNotifications()?: 'text-yellow-500 dark:text-yellow-400' }}">{{ __('Mis equipos') }}</span>
                </div>
            </div>
        </x-dropdown-link>

        <x-dropdown-divider></x-dropdown-divider>

        @if (auth()->user()->can('access admin panel'))
            <x-dropdown-link :href="route('admin.dashboard')">
                <div class="flex items-center space-x-2.5 text-sky-500 dark:text-sky-500 | hover:text-sky-600 dark:hover:text-sky-400 | focus:text-sky-600 dark:focus:text-sky-400">
                    <i class="fa solid fa-gear w-4"></i>
                    <span>Panel de Admin</span>
                </div>
            </x-dropdown-link>

            <x-dropdown-divider></x-dropdown-divider>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                <div class="flex items-center space-x-2.5 text-rose-500 dark:text-rose-500 | hover:text-rose-600 dark:hover:text-rose-400 | focus:text-rose-600 dark:focus:text-rose-400">
                    <i class="icon-logout w-4"></i>
                    <span>{{ __('Cerrar sesión') }}</span>
                </div>
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
