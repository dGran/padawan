<x-dropdown align="right" width="max">
    <x-slot name="trigger">
        <button class="border-2 border-border-color dark:border-dt-border-color | rounded-full | hover:border-edblue-400 dark:hover:border-edblue-300 | focus:outline-none focus:border-edblue-400 dark:focus:border-edblue-300 | text-dt-text-color dark:text-text-color | hover:text-dt-title-color dark:hover:text-title-color | focus:outline-none focus:text-dt-title-color dark:focus:text-title-color">
            <div class="flex items-center text-sm | rounded-full | h-8 w-8 md:h-9 md:w-9 m-0.5 | bg-text-color dark:bg-dt-text-color">
                <i class="icon-guest text-xl md:text-2xl mx-auto"></i>
            </div>
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