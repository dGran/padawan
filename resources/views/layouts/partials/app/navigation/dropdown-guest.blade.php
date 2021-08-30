<x-dropdown align="right" width="max">
    <x-slot name="trigger">
        <button class="flex items-center text-sm | rounded-full | h-10 w-10 md:h-12 md:w-12 | bg-border-color dark:bg-dt-darker | hover:bg-white dark:hover:bg-dt-dark-black hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-gray-50 dark:focus:bg-dt-dark-black focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out | border border-border-color dark:border-transparent">
            <i class="icon-guest text-2xl md:text-3xl mx-auto"></i>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('login')">
            <div class="flex items-center">
                <i class="text-base icon-login w-6 mr-2 text-center"></i>
                <span>{{ __('Iniciar sesión') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-link :href="route('register')">
            <div class="flex items-center">
                <i class="text-base icon-user-add w-6 mr-2 text-center"></i>
                <span>{{ __('Crear cuenta') }}</span>
            </div>
        </x-dropdown-link>

        <x-dropdown-divider></x-dropdown-divider>

        <x-dropdown-link :href="route('password.request')">
            <div class="flex items-center">
                <i class="text-base fas fa-key w-6 mr-2 text-center"></i>
                <span>{{ __('Recuperar contraseña') }}</span>
            </div>
        </x-dropdown-link>
    </x-slot>
</x-dropdown>