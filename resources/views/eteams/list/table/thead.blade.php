<th class="w-8"></th>
<th class="name">
    <x-link color="gray" wire:click="changeOrder('name')" class="group">
        <span>Equipo</span>
        @if($orderName==='name')
            <i class="pl-1 w-3 fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i>
        @else
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        @endif
    </x-link>
</th>
<th class="members">
    <x-link color="gray" wire:click="changeOrder('users_count')" class="group">
        <span>Miembros</span>
        @if($orderName==='users_count')
            <i class="pl-1 w-3 fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i>
        @else
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        @endif
    </x-link>
</th>
<th class="game">
    <x-link color="gray" wire:click="changeOrder('games.name')" class="group">
        <span>Juego</span>
        @if($orderName==='games.name')
            <i class="pl-1 w-3 fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i>
        @else
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        @endif
    </x-link>
</th>
<th class="location">
    <x-link color="gray" wire:click="changeOrder('location')" class="group">
        <span>Localización</span>
        @if($orderName==='location')
            <i class="pl-1 w-3 fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i>
        @else
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        @endif
    </x-link>                    
    
</th>
<th class="created_at">
    <x-link color="gray" wire:click="changeOrder('created_at')" class="group">
        <span>Fecha registro</span>
        @if($orderName==='created_at')
            <i class="pl-1 w-3 fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i>
        @else
            <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
        @endif
    </x-link>
</th>
@auth
<th class="actions"></th>
@endauth