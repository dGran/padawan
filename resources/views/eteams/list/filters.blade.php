<div class="mb-4 | flex items-center justify-end space-x-2">
    <x-input type="search" wire:model="search" placeholder="Buscar..." class="search-input | w-full"></x-input>
    <x-select id="game" wire:model="game">
        <option value="">Todos los juegos</option>
        @foreach ($etGames as $etGame)
            <option value="{{ $etGame->name }}">{{ $etGame->name }}</option>
        @endforeach
    </x-select>
</div>