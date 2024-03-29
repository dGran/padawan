<div class="p-4 border-b border-border-color dark:border-edgray-700 ">
    <ul class="flex items-center justify-start space-x-3">
        <div class="relative w-full">
            <x-input type="text" id="search" class="w-full" placeholder="Buscar..." wire:model="searchFilter" wire:keydown.escape="$set('searchFilter', '')" wire:keydown="applySearchFilter" autofocus></x-input>
            <i class="{{ $searchFilter ?: 'hidden' }} fas fa-times | absolute top-0 right-0 | h-full flex items-center | mr-3 | cursor-pointer | text-text-light-color dark:text-dt-text-light-color | hover:text-text-color dark:hover:text-dt-text-color" wire:click="clearFilter('searchFilter')"></i>
        </div>
    </ul>

    @if ($someFilterApplied)
        <ul class="mt-4 flex items-center space-x-1.5">
            @if (!empty($searchFilter))
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Buscador', 'value' => $searchFilter, 'filterName' => 'searchFilter'])
                </li>
            @endif
            @if ($userFilter !== 'all')
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Usuario', 'value' => $userFilter, 'filterName' => 'userFilter'])
                </li>
            @endif
            @if (!empty($contextFilter))
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Contexto', 'value' => $contextFilter, 'filterName' => 'contextFilter'])
                </li>
            @endif
            @if (!empty($typeFilter))
                <li>
                    @include('eteam.admin.partials.filter-tag', ['title' => 'Tipo', 'value' => $typeFilter, 'filterName' => 'typeFilter'])
                </li>
            @endif
        </ul>
    @endif
</div>
