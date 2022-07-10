<x-app-layout title="Verificación de cuenta" wfooter=1 wloader=1>

    <x-container>

        <x-card class="max-w-full md:max-w-xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Tu cuenta no está verificada
            </h4>
            <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p>

            <div class="py-3 mb-4 text-sm">
                {{ __('Gracias por registrarte! Es necesario qe valides tu cuenta, te hemos enviado un correo electrónco de verificación.') }}
            </div>

            @if(session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Reenviar email de verificación') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-button class="w-full text-center text-normal lg:text-base mt-4">
                    {{ __('Cerrar sesión') }}
                </x-button>
            </form>

        </x-card>

    </x-container>

</x-app-layout>
