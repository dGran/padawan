<th class="w-8"></th>
<th class="name">
    @if ($order == 'name')
        <x-link color="gray" wire:click="setOrder('name_desc')" class="group">
            <span>Equipo</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
        </x-link>
    @elseif ($order == 'name_desc')
        <x-link color="gray" wire:click="setOrder('name')" class="group">
            <span>Equipo</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
        </x-link>
    @else
        <x-link color="gray" wire:click="setOrder('name')" class="group">
            <span>Equipo</span>
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        </x-link>
    @endif
</th>
<th class="members">
    @if ($order == 'members')
        <x-link color="gray" wire:click="setOrder('members_desc')" class="group">
            <span>Miembros</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
        </x-link>
    @elseif ($order == 'members_desc')
        <x-link color="gray" wire:click="setOrder('members')" class="group">
            <span>Miembros</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
        </x-link>
    @else
        <x-link color="gray" wire:click="setOrder('members')" class="group">
            <span>Miembros</span>
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        </x-link>
    @endif
</th>
<th class="game">
    @if ($order == 'game')
        <x-link color="gray" wire:click="setOrder('game_desc')" class="group">
            <span>Juego</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
        </x-link>
    @elseif ($order == 'game_desc')
        <x-link color="gray" wire:click="setOrder('game')" class="group">
            <span>Juego</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
        </x-link>
    @else
        <x-link color="gray" wire:click="setOrder('game')" class="group">
            <span>Juego</span>
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        </x-link>
    @endif
</th>
<th class="location">
    @if ($order == 'location')
        <x-link color="gray" wire:click="setOrder('location_desc')" class="group">
            <span>Localización</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
        </x-link>
    @elseif ($order == 'location_desc')
        <x-link color="gray" wire:click="setOrder('location')" class="group">
            <span>Localización</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
        </x-link>
    @else
        <x-link color="gray" wire:click="setOrder('location')" class="group">
            <span>Localización</span>
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        </x-link>
    @endif                   
</th>
<th class="created_at">
    @if ($order == 'created_at')
        <x-link color="gray" wire:click="setOrder('created_at_desc')" class="group">
            <span>Fecha registro</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
        </x-link>
    @elseif ($order == 'created_at_desc')
        <x-link color="gray" wire:click="setOrder('created_at')" class="group">
            <span>Fecha registro</span>
            <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
        </x-link>
    @else
        <x-link color="gray" wire:click="setOrder('created_at')" class="group">
            <span>Fecha registro</span>
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        </x-link>
    @endif    
</th>
@auth
<th class="actions"></th>
@endauth