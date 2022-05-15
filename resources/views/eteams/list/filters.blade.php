<div class="mb-4 | flex items-center justify-end space-x-2">

    <x-input type="search" wire:model="name" placeholder="Buscar..." class="w-full"></x-input>
    <x-select class="w-full" id="game" wire:model="game">
        <option value="">N/D</option>
        @foreach ($etGames as $etGame)
            <option value="{{ $etGame->name }}">{{ $etGame->name }}</option>
        @endforeach
    </x-select>

</div>