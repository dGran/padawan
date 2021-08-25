<x-app-layout>

    <x-container>

        <x-card class="max-w-full lg:max-w-xl mx-auto mt-4 lg:mt-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Inicia sesión
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <form method="POST" action="{{ route('login') }}" class="pt-6">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Correo electrónico')" />
                    <x-input id="email" class="block mt-1.5 w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    placeholder="Escribe tu correo electrónico"
                                    required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />
                    <x-input id="password" class="block mt-1.5 w-full"
                                    type="password"
                                    name="password"
                                    placeholder="Escribe tu contraseña"
                                    required autocomplete="current-password" />
                </div>

                <div class="pt-6">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Iniciar sesión') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <p class="pt-4 text-center">
                        ¿No tienes una cuenta? <x-link href="{{ route('register') }}">Regístrate</x-link>
                        @if (Route::has('password.request'))
                            <x-link href="{{ route('password.request') }}" class="block mt-2">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </x-link>
                        @endif
                    </p>
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>