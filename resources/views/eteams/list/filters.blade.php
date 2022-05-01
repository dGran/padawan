<div class="mb-4 | flex items-center justify-end space-x-2">

    <x-input type="search" wire:model="name" placeholder="Buscar..." class="w-full"></x-input>

    <div class="group | flex items-center | rounded | border border-border-color dark:border-gray-700 | hover:border-gray-200 dark:hover:border-gray-600">
        <x-button-link
            wire:click="$set('view', 'table')"
            class="text-lg | rounded-l | px-3 py-1.5 | bg-white dark:bg-dt-dark | focus:outline-none | border-border-color dark:border-gray-700 group-hover:border-gray-200 dark:group-hover:border-gray-600 {{ $view == 'table' ? 'border-r | pointer-events-none' : '' }}">
            <i class="fa-solid fa-table-list {{ $view != 'table' ?: 'opacity-25' }}"></i>
        </x-button-link>

        <x-button-link
            wire:click="$set('view', 'card')"
            class="text-lg | rounded-r | px-3 py-1.5 | bg-white dark:bg-dt-dark | focus:outline-none | border-border-color dark:border-gray-700 group-hover:border-gray-200 dark:group-hover:border-gray-600 {{ $view == 'card' ? 'border-l | pointer-events-none' : '' }}">
            <i class="fa-solid fa-address-card {{ $view != 'card' ?: 'opacity-25' }}"></i>
        </x-button-link>
    </div>

</div>