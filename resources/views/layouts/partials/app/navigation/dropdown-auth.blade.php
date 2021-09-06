<x-dropdown align="right" width="max">
    <x-slot name="trigger">
        <button class="flex items-center text-sm | rounded-full | h-10 w-10 md:h-12 md:w-12 | bg-border-color dark:bg-dt-darker | hover:bg-white dark:hover:bg-dt-dark-black hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-gray-50 dark:focus:bg-dt-dark-black focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out | border border-border-color dark:border-transparent">
            <i class="icon-user-menu text-2xl md:text-3xl mx-auto"></i>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('account')">
            <div class="flex items-center">
                <i class="text-base fas fa-id-badge w-6 mr-2 text-center"></i>
                <span>{{ __('Mi cuenta') }}</span>
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