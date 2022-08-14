<div class="p-4 border-b border-border-color dark:border-edgray-700 ">
    <button type="submit" class="px-4 py-2.5 mb-3 bg-green-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out" wire:click="create()">
        <span>{{ __('Nueva noticia') }}</span>
    </button>
    <div class="relative w-full">
        <x-input type="text" id="search" class="w-full" placeholder="Buscar..." wire:model="searchFilter" wire:keydown.escape="$set('searchFilter', '')" wire:keydown="applySearchFilter" autofocus></x-input>
        <i class="{{ $searchFilter ?: 'hidden' }} fas fa-times | absolute top-0 right-0 | h-full flex items-center | mr-3 | cursor-pointer | text-text-light-color dark:text-dt-text-light-color | hover:text-text-color dark:hover:text-dt-text-color" wire:click="clearFilter('searchFilter')"></i>
    </div>

    @if ($someFilterApplied)
        <ul class="mt-4 flex items-center space-x-1.5">
            @if (!empty($searchFilter))
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Buscador', 'value' => $searchFilter, 'filterName' => 'searchFilter'])
                </li>
            @endif
            @if ($visibilityFilter !== 'all')
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Visibilidad', 'value' => $visibilityFilter, 'filterName' => 'visibilityFilter'])
                </li>
            @endif
            @if ($userFilter !== 'all')
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Usuario', 'value' => $userFilter, 'filterName' => 'userFilter'])
                </li>
            @endif
        </ul>
    @endif
</div>
