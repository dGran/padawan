<x-app-layout title="Inicia sesión" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full md:max-w-xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
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
                    <input id="email" class="block mt-1.5 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                             placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                             focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                             autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                             autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    placeholder="Escribe tu correo electrónico"
                                    required autofocus />
                </div>

                <!-- Password -->
                <div x-data="{ show: true }" class="mt-4">
                    <div class="relative">
                        <input placeholder="Escribe tu contraseña" :type="show ? 'password' : 'text'" name="password"
                               class="block mt-1.5 w-full | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                      placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                      focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                      autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                      autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                        required autocomplete="current-password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <i class="cursor-pointer text-lg" x-bind:class="{ 'icon-visible' : show, 'icon-invisible' : !show }" @click="show = !show"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-6 text-center">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Iniciar sesión') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <p class="pt-4">
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
