<x-app-layout title="Crea tu cuenta" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full md:max-w-2xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Crea tu cuenta
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <form method="POST" action="{{ route('register') }}" class="pt-6">
                @csrf
                <!-- Name & Email Address -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label for="name" :value="__('Nombre')" />
                        <input id="name" class="block sm:mt-1 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                                placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                                focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                                autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                                autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                        type="text"
                                        name="name"
                                        :value="old('name')"
                                        placeholder="Nombre"
                                        required autofocus/>
                    </div>

                    <div>
                        <x-label for="email" :value="__('Correo electrónico')" />
                        <input id="email" class="block sm:mt-1 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                                 placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                                 focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                                 autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                                 autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        placeholder="Correo electrónico"
                                        required />
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label for="password" :value="__('Contraseña')" />
                        <input id="password" class="block sm:mt-1 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                                      placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                                      focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                                      autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                                      autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                        type="password"
                                        name="password"
                                        placeholder="Contraseña"
                                        required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                        <input id="password_confirmation" class="block sm:mt-1 w-full | appearance-none | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 |
                                                                   placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 |
                                                                   focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 |
                                                                   autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color |
                                                                   autofill:shadow-fill-edgray-300 dark:autofill:shadow-fill-dt-dark-accent"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Repetir contraseña"
                                        required />
                    </div>
                </div>

                <div class="pt-6 text-center">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Regístrate ahora') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <p class="pt-4">
                        ¿Ya tienes cuenta? <x-link href="{{ route('login') }}">Inicia sesión</x-link>
                    </p>
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
