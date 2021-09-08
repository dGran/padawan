<x-app-layout title="Inicia sesión" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full lg:max-w-xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                <i class="fas fa-user-lock | text-4xl md:text-5xl | block | mb-2 | text-red-500 dark:text-red-400"></i>
                <span class="block | mb-4 | text-base lg:text-lg | text-red-500 dark:text-red-400">{{ __('Esta es un área segura de la aplicación.') }}</span>
                {{ __('Confirma tu contraseña antes de continuar.') }}
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="pt-6">
                @csrf

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />
                    <div x-data="{ show: true }">
                        <div class="relative">
                            <input placeholder="Escribe tu contraseña" :type="show ? 'password' : 'text'" name="password" class="block mt-1.5 w-full | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500 | autofill:border-border-color dark:autofill:border-gray-700 | autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color | autofill:shadow-fill-white dark:autofill:shadow-fill-dt-dark"
                            required autocomplete="current-password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <i class="cursor-pointer text-lg" x-bind:class="{ 'icon-visible' : show, 'icon-invisible' : !show }" @click="show = !show"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Confirmar contraseña') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

{{--                     <p class="pt-4 text-center">
                        <x-link href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </x-link>
                    </p> --}}
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
