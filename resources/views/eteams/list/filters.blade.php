<div class="mb-4 | flex items-center justify-end">
    <x-input type="search" wire:model="search" placeholder="Buscar..." class="search-input | w-full"></x-input>
    <div class="pl-3 | flex items-center space-x-0">
        <select id="game" wire:model="game" class="appearance-none | rounded-l-md | px-4 py-2 | bg-white dark:bg-dt-dark | border-l border-t border-b border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500 | autofill:border-border-color dark:autofill:border-gray-700 | autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color | autofill:shadow-fill-white dark:autofill:shadow-fill-dt-dark
        ||||  | hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-10 w-auto | border-gray-200 ">
            <option value="">Todos los juegos</option>
            @foreach ($etGames as $etGame)
                <option value="{{ $etGame->name }}">{{ $etGame->name }}</option>
            @endforeach
        </select>
        <button wire:click="toggleView" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-10 w-10 | border border-gray-200 dark:border-gray-700 | rounded-r-md | focus:outline-none">
            <i class="fa-solid {{ $view != 'table' ? 'fa-address-card' : 'fa-table-list' }}" title="{{ $view != 'table' ? 'Cambiar vista Tabla' : 'Cambiar vista Card' }}"></i>
        </button>
    </div>
</div>