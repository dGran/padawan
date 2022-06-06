@include('account.menu')

<x-container>

    <div class="mt-8">

        <div class="relative my-2 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{selected:null}">

            <button type="button" class="group | w-full px-4 py-2.5 text-left text-title-color dark:text-dt-title-color focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                <div class="flex items-center justify-between space-x-4">
                    <i class="flex-initial text-xxs fas fa-user-shield"></i>
                    <span class="flex-1">Mis equipos</span>
                    <i class="flex-initial text-xxs | border border-transparent rounded-full px-1.5 py-1 group-focus:border-gray-300 dark:group-focus:border-edgray-600 | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                </div>
            </button>

            <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                <div class="p-6">
                    <p>reCAPTCHA v2 is not going away! We will continue to fully support and improve security and usability for v2.</p>
                    <p>reCAPTCHA v3 is intended for power users, site owners that want more data about their traffic, and for use cases in which it is not appropriate to show a challenge to the user.</p>
                    <p>For example, a registration page might still use reCAPTCHA v2 for a higher-friction challenge, whereas more common actions like sign-in, searches, comments, or voting might use reCAPTCHA v3. To see more details, see the reCAPTCHA v3 developer guide.</p>
                </div>
            </div>

        </div>
    </div>
    <style>
        .max-h-0 {
            max-height: 0;
        }
    </style>


    <section class="mb-8 flex flex-col md:flex-row justify-between items-start space-y-4 md:space-y-0  md:space-x-8">

        <div class="w-full">
            <x-card class="w-full">
                <div class="flex flex-col items-center | p-5 md:p-7">
                    <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name . " avatar" }}" class="rounded-full | w-20 h-20 md:w-24 md:h-24 | object-cover">
                    <div class="flex flex-col items-center mt-3">
                        <span class="text-base md:text-lg | font-semibold | text-title-color dark:text-dt-title-color">{{ $user->name }}</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <x-link-button class="min-w-max mt-6 | font-miriam | uppercase" href="{{ route('edit-profile') }}">Editar Perfil</x-link-button>
                </div>

                <div class="border-t border-border-color dark:border-dt-border-color | p-5 md:p-7">

                    <div class="flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Edad:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->getAge())
                                {{ $user->getAge() }} {{ $user->getAge() == 1 ? 'año' : 'años' }}
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Nacionalidad:</h4>
                        <div class="ml-2.5 overflow-ellipsis overflow-hidden | flex items-center">
                            @if ($user->profile->country_id)
                                <img src="{{ $user->profile->getFlag() }}" alt="{{ $user->profile->getCountryName() }}" class="w-6 object-cover rounded mr-2">
                                <p>{{ $user->profile->getCountryName() }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Lugar de residencia:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->location)
                                {{ $user->profile->location }}
                            @endif
                        </p>
                    </div>

                    <div class="mt-6 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Whatsapp:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->whatsapp)
                                <x-link href="https://wa.me/{{ $user->profile->whatsapp }}" target="_blank">{{ $user->profile->whatsapp }}</x-link>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Facebook:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->facebook)
                                <x-link href="{{ $user->profile->getFacebookUrl() }}" target="_blank">{{ $user->profile->getFacebookUrl() }}</x-link>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Twitter:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->twitter)
                                <x-link href="{{ $user->profile->getTwitterUrl() }}" target="_blank">{{ $user->profile->getTwitterUrl() }}</x-link>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Instagram:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->instagram)
                                <x-link href="{{ $user->profile->getInstagramUrl() }}" target="_blank">{{ $user->profile->getInstagramUrl() }}</x-link>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Twitch:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->twitch)
                                <x-link href="{{ $user->profile->getTwitchUrl() }}" target="_blank">{{ $user->profile->getTwitchUrl() }}</x-link>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Discord:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->discord)
                                <x-link href="{{ $user->profile->discord }}" target="_blank">{{ $user->profile->discord }}</x-link>
                            @endif
                        </p>
                    </div>

                    <div class="mt-6 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">PlayStation:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->ps_id)
                                <span>{{ $user->profile->ps_id }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Xbox:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->xbox_id)
                                <span>{{ $user->profile->xbox_id }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Steam:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->steam_id)
                                <span>{{ $user->profile->steam_id }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1.5 | flex items-center">
                        <h4 class="font-semibold | text-title-color dark:text-dt-title-color">Origin:</h4>
                        <p class="ml-2.5 overflow-ellipsis overflow-hidden">
                            @if ($user->profile->origin_id)
                                <span>{{ $user->profile->origin_id }}</span>
                            @endif
                        </p>
                    </div>

                </div>
            </x-card>

        </div>

        {{-- @livewire('account.edit-profile') --}}
    </section>
</x-container>
