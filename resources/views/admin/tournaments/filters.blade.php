<h4 class="text-bold pb-1">
    Filtros
</h4>
<div class="flex sm:flex-row flex-col pb-2">
    <div class="flex flex-row mb-1 sm:mb-0">
        <div class="relative">
            <input type="hidden" id="sortField" name="sortField" value="{{ $sortField }}">
            <input type="hidden" id="sortDirection" name="sortDirection" value="{{ $sortDirection }}">
            <select name="perPage" class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onchange="applyFilters()">
                <option {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option {{ $perPage == 8 ? 'selected' : '' }}>8</option>
                <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                <option {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                <option {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
        <div class="relative">
            <select
                class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                <option>All</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="block relative">
        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                <path
                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                </path>
            </svg>
        </span>
        <input placeholder='Buscar...(Presiona "/")' name="filterName" id="filterName"
            class="search-input appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" value="{{ $filterName }}"/>
    </div>

</div>

@if ($filterName)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">Nombre<i class="fas fa-times pl-1"></i></button>
        @endif
    </div>
@endif