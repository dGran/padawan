@foreach ($eteams as $eteam)
<tr class="group | border-t border-border-color dark:border-gray-700 | hover:bg-gray-100 dark:hover:bg-dt-darker" wire:loading.class = "opacity-75">
    <td class="py-1.5 px-3">
        @if($eteam->open)
            <i class="fa-solid fa-unlock text-base text-yellow-500" title="El equipo acepta solicitudes"></i>
        @else
            <i class="fa-solid fa-lock text-base" title="El equipo no acepta solicitudes"></i>
        @endif
    </td>
    <td class="py-1.5 px-3 | flex items-center space-x-1.5">
        <img src="{{ $eteam->getLogo() }}" alt="" class="w-10 h-10 rounded-full bg-white dark:bg-dt-dark object-contain p-0.5 | border border-gray-200 dark:border-gray-700">
        <x-link href="{{ route('eteams.eteam', $eteam->slug) }}" class="group-hover:underline | w-full flex items-center justify-between truncate">            
            <span class="truncate">{{ $eteam->name }}</span>
            <span class="font-mono">[{{ $eteam->short_name }}]</span>
        </x-link>
    </td>
    <td class="py-1.5 px-3 | text-center">
        {{ $eteam->users_count }}
    </td>
    <td class="py-1.5 px-3">
        <span>
            {{ $eteam->game->name }}
        </span>
    </td>
    <td class="py-1.5 px-3">
        <div class='flex items-center truncate'>
        @if($eteam->location)            
            @if($eteam->country)
                <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}">
                <span class="ml-1.5">{{ $eteam->location }},</span>
                <span class="truncate ml-1">{{ $eteam->getCountryName() }}</span>
            @else 
                <span>{{ $eteam->location }}</span>
            @endif        
        @elseif($eteam->country)
            <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}">
            <span class="ml-1.5">{{ $eteam->getCountryName() }}</span>
        @else
            <span class="text-text-light-color dark:text-dt-textlight-color">N/D</span>
        @endif
        </div>
            
    </td>
    <td class="py-1.5 px-3">
        {{ $eteam->getCreatedAtFormated() }}
    </td>
    @auth
    <td>
        @if($eteam->open)
            @if(!auth()->user()->eteamMember($eteam->id))
                @if(auth()->user()->eteamInvitation($eteam->id))
                    <x-link href="{{ route('myteams') }}">Invitación recibida</x-link>
                @else
                    @if(auth()->user()->eteamRequest($eteam->id))
                        <div class="flex flex-col">
                            <span>Solicitud enviada</span>
                            <span class="text-text-light-color dark:text-dt-text-light-color text-xxs">STATE: {{ auth()->user()->eteamRequestState($eteam->id) }}</span>
                        </div>
                    @else
                        <x-button>
                            Solicitar ingreso
                        </x-button>
                    @endif
                @endif
            @endif
        @endif
    </td>
    @endauth

</tr>
@endforeach