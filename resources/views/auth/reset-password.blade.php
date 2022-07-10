<x-app-layout title="Reestablecer contraseña" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full md:max-w-xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Reestablecer contraseña
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="pt-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                    <x-label for="password" :value="__('Nueva contraseña')" />
                    <x-input id="password" class="block sm:mt-1 w-full"
                             type="password"
                             name="password"
                             placeholder="Contraseña"
                             required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                    <x-input id="password_confirmation" class="block sm:mt-1 w-full"
                             type="password"
                             name="password_confirmation"
                             placeholder="Repetir contraseña"
                             required />
                </div>


                <div class="pt-6 text-center">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Reestablecer contraseña') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />
                </div>
            </form>
        </x-card>

    </x-container>

</x-app-layout>
