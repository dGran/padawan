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
        <x-dropdown-link :href="route('notifications')">
            <div class="flex items-center relative">
                <i class="text-base fas fa-bell w-6 mr-2 text-center {{ !auth()->user()->countNotifications() ?: 'text-yellow-500 dark:text-yellow-400' }}"></i>
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
            <div class="flex items-center relative">
                <i class="text-base fas fa-user-shield w-6 mr-2 text-center {{ !auth()->user()->countInvitations() ?: 'text-yellow-500 dark:text-yellow-400' }}"></i>
                <div class="flex items-center space-x-1.5">
                    @if (auth()->user()->countInvitations())
                        <span class="text-yellow-500 dark:text-yellow-400 font-bold">
                            ({{ auth()->user()->countInvitations() < 9 ? auth()->user()->countInvitations() : '+9' }})
                        </span>
                    @endif
                    <span class="{{ !auth()->user()->countInvitations()?: 'text-yellow-500 dark:text-yellow-400' }}">{{ __('Mis equipos') }}</span>
                </div>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('account')">
            <div class="flex items-center">
                <i class="text-base fas fa-id-badge w-6 mr-2 text-center"></i>
                <span>{{ __('Mi cuenta') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-divider></x-dropdown-divider>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" class="" onclick="event.preventDefault(); this.closest('form').submit();">
                <div class="flex items-center text-red-500 dark:text-red-500 | hover:text-red-600 dark:hover:text-red-400 | focus:text-red-600 dark:focus:text-red-400">
                    <i class="text-base icon-logout w-6 mr-2 text-center"></i>
                    <span>{{ __('Cerrar sesión') }}</span>
                </div>
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
