<x-dropdown align="right" width="max">
    <x-slot name="trigger">
        <img src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user() . " avatar" }}" class="rounded-full | object-cover | w-8 h-8 md:w-10 md:h-10 | bg-edgray-150 dark:bg-gray-600 | border border-gray-200 dark:border-gray-600 | group-hover:border-gray-300 dark:group-hover:border-gray-500 | focus:outline-none group-focus:border-gray-300 dark:group-focus:border-gray-500 | transition duration-150 ease-in-out | cursor-pointer">
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('account')">
            <div class="flex items-center">
                <i class="text-base fas fa-id-badge w-6 mr-2 text-center"></i>
                <span>{{ __('Mi cuenta') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('notifications')">
            <div class="flex items-center">
                <i class="text-base fas fa-bell w-6 mr-2 text-center"></i>
                <span>{{ __('Notificaciones') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('myteams')">
            <div class="flex items-center">
                <i class="text-base fas fa-user-shield w-6 mr-2 text-center"></i>
                <span>{{ __('Mis equipos') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-divider></x-dropdown-divider>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" class=""
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                <div class="flex items-center text-red-500 dark:text-red-500 | hover:text-red-600 dark:hover:text-red-400 | focus:text-red-600 dark:focus:text-red-400">
                    <i class="text-base icon-logout w-6 mr-2 text-center"></i>
                    <span>{{ __('Cerrar sesión') }}</span>
                </div>
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>