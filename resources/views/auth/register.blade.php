<x-app-layout title="Crea tu cuenta" wfooter="1">

    <x-container>

        <x-card class="max-w-full lg:max-w-2xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Crea tu cuenta
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <form method="POST" action="{{ route('register') }}" class="pt-6">
                @csrf
                <!-- Name & Email Address -->
                <div class="flex items-center gap-6 mt-4">
                    <div class="flex-1">
                        <x-label for="name" :value="__('Nombre')" />
                        <x-input id="name" class="block mt-1.5 w-full"
                                        type="text"
                                        name="name"
                                        :value="old('name')"
                                        placeholder="Nombre"
                                        required autofocus/>
                    </div>

                    <div class="flex-1">
                        <x-label for="email" :value="__('Correo electrónico')" />
                        <x-input id="email" class="block mt-1.5 w-full"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        placeholder="Correo electrónico"
                                        required />
                    </div>
                </div>

                <!-- Password -->
                <div class="flex items-center gap-6 mt-4">
                    <div class="flex-1">
                        <x-label for="password" :value="__('Contraseña')" />
                        <x-input id="password" class="block mt-1.5 w-full"
                                        type="password"
                                        name="password"
                                        placeholder="Contraseña"
                                        required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex-1">
                        <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Repetir contraseña"
                                        required />
                    </div>
                </div>

                <div class="pt-6">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Regístrate ahora') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />

                    <p class="pt-4 text-center">
                        ¿Ya tienes cuenta? <x-link href="{{ route('login') }}">Inicia sesión</x-link>
                    </p>
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
