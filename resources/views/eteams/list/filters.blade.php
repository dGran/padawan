<div class="mb-4 | flex items-center justify-end space-x-2">
    <x-input type="search" wire:model="name" placeholder="Buscar..." class="w-full"></x-input>
    <x-select id="game" wire:model="game">
        <option value="">Todos</option>
        @foreach ($etGames as $etGame)
            <option value="{{ $etGame->name }}">{{ $etGame->name }}</option>
        @endforeach
    </x-select>
    <x-button>
        <i class="fa-solid fa-filter"></i>
    </x-button>
    <x-select id="users" wire:model="users">
        <option value="">Todos</option>
        <option value="1">1 ó más miembros</option>
        <option value="5">5 ó más miembros</option>
        <option value="10">10 ó más miembros</option>
    </x-select>
</div>