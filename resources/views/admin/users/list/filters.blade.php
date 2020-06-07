@include('admin.users.list.filters_modal')

<div class="clearfix w-full">
    <div class="relative float-left w-2/3">
        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                <path
                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                </path>
            </svg>
        </span>
        <input placeholder='Buscar...("/")' name="filterName" id="filterName"
    class="search-input rounded border border-gray-400 border-b block pl-8 pr-2 py-2 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:border-gray-500 focus:text-gray-700 focus:outline-none w-full" value="{{ $filterName }}"/>
    </div>
    <div class="float-right w-auto text-right pl-2">
        <button class="inline-block bg-gray-100 text-gray-700 border border-gray-400 h-full rounded px-3 py-2 focus:outline-none focus:bg-white hover:bg-white hover:text-gray-900" type="button" onclick="showHideFilters()">
            <i class="icon-filter lg:mr-1"></i>
            <span class="hidden lg:inline-block">Filtros</span>
        </button>
        <button class="inline-block bg-gray-100 text-gray-700 border border-gray-400 h-full rounded px-3 py-2 focus:outline-none focus:bg-white hover:bg-white hover:text-gray-900" onclick="showHideGlobalOptions()">
            <i class="icon-table lg:mr-1"></i>
            <span class="hidden lg:inline-block">Tabla</span>
        </button>
    </div>
</div>