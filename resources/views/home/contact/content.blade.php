    @include('layouts.partials.flash_errors')

    @include('layouts.partials.flash_status_messages')

    <div class="container max-w-full mx-auto pt-4 pb-12 px-6 text-gray-800">
        <div class="max-w-lg mx-auto px-2 md:px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="mt-6">
                        <h1 class="text-center font-semibold text-black text-2xl">
                            <i class="fas fa-id-card block text-6xl mb-3"></i>
                            {{ __('Formulario de contacto') }}
                        </h1>

                        <form class="mt-8" method="POST" action="{{ route('contact') }}">
                            @csrf
                            @honeypot
                            <div class="mx-auto max-w-lg">
                                <div class="py-2">
                                    <label class="px-1 text-sm text-gray-600" for="name">
                                        *{{ __('Nombre') }}
                                    </label>
                                    <input type="text" placeholder="Nombre" name="name" id="name" value="{{ old('name') || auth()->user() ? auth()->user()->name : '' }}" autofocus class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:bg-white focus:border-gray-600 w-full pr-10"/>
                                    <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <div class="py-2">
                                    <label class="px-1 text-sm text-gray-600" for="whatsapp">
                                        {{ __('Whatsapp') }}
                                    </label>
                                    <input type="number" placeholder="Número de Whatsapp" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') || auth()->user() ? auth()->user()->profile->whatsapp : '' }}" class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:bg-white focus:border-gray-600 w-full pr-10"/>
                                    <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                </div>
                                <div class="py-2">
                                    <label class="px-1 text-sm text-gray-600" for="email">
                                        *{{ __('E-Mail') }}
                                    </label>
                                    <input type="text" placeholder="Dirección de E-Mail" name="email" id="email" value="{{ old('email') || auth()->user() ? auth()->user()->email : '' }}" autofocus class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:bg-white focus:border-gray-600 w-full pr-10"/>
                                    <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                        <i class="fas fa-at"></i>
                                    </span>
                                </div>
                                <div class="py-2">
                                    <label class="px-1 text-sm text-gray-600" for="email">
                                        *{{ __('Mensaje') }}
                                    </label>
                                    <textarea name="message" id="message" rows="5" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:bg-white focus:border-gray-600 w-full">{{ old('message') }}</textarea>
                                </div>
                                <button class="mt-3 text-lg font-semibold bg-gray-800 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-black focus:outline-none">
                                    {{ __('Enviar') }}
                                </button>

                                <div class="mt-3 text-sm text-gray-600">* Campos requeridos</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>