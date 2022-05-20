<th class="text-left py-2.5 px-3">
    <x-link color="gray" wire:click="changeOrder('name')">
        <span>Equipo</span>
        @if($orderName==='name') <i class="fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i> @endif
    </x-link>
</th>
<th class="text-left py-2.5 px-3">
    <x-link color="gray" wire:click="changeOrder('location')">
        <span>Localización</span>
        @if($orderName==='location') <i class="fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i> @endif
    </x-link>                    
    
</th>
<th class="text-left py-2.5 px-3">
    <x-link color="gray" wire:click="changeOrder('games.name')">
        <span>Juego</span>
        @if($orderName==='games.name') <i class="fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i> @endif
    </x-link>
</th>
<th class="w-24 | text-center py-2.5 px-3">Miembros</th>
<th class="w-48 | text-center py-2.5 px-3">
    <x-link color="gray" wire:click="changeOrder('created_at')">
        <span>Fecha registro</span>
        @if($orderName==='created_at') <i class="fa-solid fa-arrow-{{ $orderSort==='asc' ? 'up' : 'down' }}-short-wide"></i> @endif
    </x-link>
</th>