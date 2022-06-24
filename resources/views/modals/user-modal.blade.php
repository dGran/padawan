<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    <div class="flex flex-col sm:flex-row items-center justify-start sm:space-x-6 | p-6">
        <img src="{{ $user->getAvatarUrl() }}" alt="" class="w-32 h-32 | rounded-full | border border-border-color dark:border-dt-border-color">
        <div class="flex flex-col items-center sm:items-start space-y-0.5">
            <h3 class="text-xl | pt-3 sm:pt-0 font-medium text-title-color dark:text-dt-title-color">
                {{ $user->name }}
            </h3>
            <x-link class="text-xs | flex items-center" href="mailto:{{ $user->email }}">
                <i class="fa-solid fa-envelope mr-1"></i>
                <span>{{ $user->email }}</span>
            </x-link>
            @if ($user->profile)
                <div class="flex items-center text-sm pt-2">
                    @if($user->profile->location)
                        @if($user->profile->country)
                            <img src="{{ $user->profile->country->getFlag24() }}" alt="{{ $user->profile->getCountryName() }}">
                            <span class="ml-1.5">{{ $user->profile->location }},</span>
                            <span class="truncate ml-1">{{ $user->profile->getCountryName() }}</span>
                        @else
                            <span>{{ $user->profile->location }}</span>
                        @endif
                    @elseif($user->profile->country)
                        <img src="{{ $user->profile->country->getFlag24() }}" alt="{{ $user->profile->getCountryName() }}">
                        <span class="ml-1.5">{{ $user->profile->getCountryName() }}</span>
                    @else
                        <span class="text-text-light-color dark:text-dt-textlight-color">Localización N/D</span>
                    @endif
                </div>
                <p class="text-sm {{ $user->getAge() ? $user->getAge() . '' : 'text-text-light-color dark:text-dt-textlight-color' }}">{{ $user->getAge() ? $user->getAge() . ' años' : 'Edad N/D' }}</p>
            @else
                <p class="text-sm text-text-light-color dark:text-dt-textlight-color pt-3 animate-pulse">Perfil no configurado</p>
            @endif
        </div>
    </div>

    @if ($user->hasAnyGamerProfile())
        <div class="flex flex-col items-start space-y-0.5 text-sm px-6 py-4 border-t border-border-color dark:border-edgray-700">
            @if ($user->profile->xbox_id)
                <p>
                    <span class="font-medium text-title-color dark:text-dt-title-color mr-1.5">Xbox Gamertag:</span>
                    <span>{{ $user->profile->xbox_id }}</span>
                </p>
            @endif
            @if ($user->profile->ps_id)
                <p>
                    <span class="font-medium text-title-color dark:text-dt-title-color mr-1.5">PlayStation Id:</span>
                    <span>{{ $user->profile->ps_id }}</span>
                </p>
            @endif
            @if ($user->profile->steam_id)
                <p>
                    <span class="font-medium text-title-color dark:text-dt-title-color mr-1.5">Steam Id:</span>
                    <span>{{ $user->profile->steam_id }}</span>
                </p>
            @endif
            @if ($user->profile->origin_id)
                <p>
                    <span class="font-medium text-title-color dark:text-dt-title-color mr-1.5">Origin Id:</span>
                    <span>{{ $user->profile->origin_id }}</span>
                </p>
            @endif
        </div>
    @endif


    @if ($user->hasAnySocialNetwork())
        <div class="flex items-center justify-center space-x-0.5 px-6 py-4 border-t border-border-color dark:border-edgray-700">
            <a class="{{ $user->profile->whatsapp ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{-- {{ $user->profile->getWhatsappUrl() }} --}}" target="_blank">
                <i class="icon-whatsapp mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->twitter ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getTwitterUrl() }}" target="_blank">
                <i class="icon-twitter mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->facebook ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getFacebookUrl() }}" target="_blank">
                <i class="icon-facebook mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->instagram ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getInstagramUrl() }}" target="_blank">
                <i class="icon-instagram mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->twitch ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getTwitchUrl() }}" target="_blank">
                <i class="icon-twitch mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->discord ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{-- {{ $user->profile->getDiscordUrl() }} --}}" target="_blank">
                <i class="icon-discord mr-3 rounded-full text-xl"></i>
            </a>
        </div>
    @endif
</div>
