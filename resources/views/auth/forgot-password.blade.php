<x-app-layout title="Recupera tu contraseña" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full md:max-w-xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Recupera tu contraseña
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <div class="mt-8 mb-2 text-text-light-color dark:text-dt-text-light-color text-xxs md:text-xs text-center">
                {{ __('¿Olvidaste tu contraseña? No hay problema, introduce tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="pt-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Correo electrónico')" />
                    <input id="email" class="block mt-1.5 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                               placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                               focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                               autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                               autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    placeholder="Correo electrónico"
                                    required autofocus />
                </div>

                <div class="pt-6 text-center">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Recuperar contraseña') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <div class="pt-4">
                        <p>¿No tienes una cuenta? <x-link href="{{ route('register') }}">Regístrate</x-link></p>
                        <p>Si ya tienes una cuenta puedes <x-link href="{{ route('register') }}">Iniciar sesión</x-link></p>
                    </div>
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
