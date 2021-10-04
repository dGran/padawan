{{-- breadcrumb --}}
@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>Mi cuenta</span>
    </li>
@endsection


<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start space-y-4 md:space-y-0  md:space-x-8">
        @include('account.menu', ['activeTab' => 'Account'])

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
