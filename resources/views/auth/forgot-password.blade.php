<x-app-layout>

    <x-container>

        <x-card class="max-w-full lg:max-w-xl mx-auto mt-4 lg:mt-8 p-8 | text-xs lg:text-sm">
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
                    <x-input id="email" class="block mt-1.5 w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    placeholder="Correo electrónico"
                                    required autofocus />
                </div>

                <div class="pt-6">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Recuperar contraseña') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <div class="pt-4 text-center">
                        <p>¿No tienes una cuenta? <x-link href="{{ route('register') }}">Regístrate</x-link></p>
                        <p>Si ya tienes una cuenta puedes <x-link href="{{ route('register') }}">Iniciar sesión</x-link></p>
                    </div>
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
