<div class="py-3 | flex items-center justify-center | border-b border-border-color dark:border-dt-border-color">
    @if($eteam->member_requests)
        @if(!auth()->user()->isEteamMember($eteam->id))
            @if(auth()->user()->eteamInvitation($eteam->id))
                <x-link href="{{ route('myteams') }}">Invitación recibida</x-link>
            @else
                @if(auth()->user()->eteamRequest($eteam->id))
                    <div class="flex flex-col">
                        <span class="{{ auth()->user()->eteamRequestState($eteam->id) === 'pendiente' ?: 'text-red-500 dark:text-red-400' }}">
                            Solicitud {{ auth()->user()->eteamRequestState($eteam->id) === 'pendiente' ? 'enviada' : 'rechazada' }}
                        </span>
                        <a class="text-xxs" wire:click="CancelRequestJoin({{ $eteam->id }})" class="cursor-pointer | hover:underline focus:underline focus:outline-none">
                            Retirar solicitud
                        </a>
                    </div>
                @else
                    <x-button wire:click="RequestJoin({{ $eteam->id }})">
                        Solicitar ingreso
                    </x-button>
                @endif
            @endif
        @else
            <div class="">
                <div class="p-1.5 bg-indigo-800 items-center text-indigo-100 leading-none rounded-full inline-flex" role="alert">
                    <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xxs font-bold mr-3">New</span>
                    <span class="font-semibold mr-2 text-left flex-auto">Miembro</span>
                </div>
            </div>
        @endif
    @else
        <div class="flex flex-col items-center">
            <i class="fa-solid fa-lock text-2xl lg:text-3xl pb-1.5"></i>
            <span>El equipo no admite solicitudes para nuevos miembros.</span>
            <span>Sólo se puede ingresar en el equipo mediante invitación.</span>
        </div>
    @endif
</div>
