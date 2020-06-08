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
        <button class="hidden md:inline-block hint--top-left hint-medium hint--rounded hint--info hint--bounce mr-2 text-blue-500" type="button" aria-label='Atajos de teclado: "/" (buscar) - "ALT+F" (ver/ocultar Filtros) - "ALT+T" (ver/ocultar Opciones de Tabla)'>
            <i class="icon-shortcut"></i>
        </button>
        <button class="inline-block bg-gray-100 text-gray-700 border border-gray-400 h-full rounded px-3 py-2 focus:outline-none focus:bg-white hover:bg-white hover:text-gray-900 hint--top-left hint-medium hint--rounded hint--bounce" type="button" onclick="showHideFilters()" aria-label="Mostrar Filtros">
            <i class="icon-filter lg:mr-1"></i>
            <span class="hidden lg:inline-block">Filtros</span>
        </button>
        <button class="inline-block bg-gray-100 text-gray-700 border border-gray-400 h-full rounded px-3 py-2 focus:outline-none focus:bg-white hover:bg-white hover:text-gray-900 hint--top-left hint-medium hint--rounded hint--bounce" onclick="showHideGlobalOptions()" aria-label="Mostrar/ocultar Opciones globales de tabla">
            <i class="icon-table lg:mr-1"></i>
            <span class="hidden lg:inline-block">Tabla</span>
        </button>
        <button class="inline-block bg-green-500 text-white border border-green-700 h-full rounded px-3 py-2 focus:outline-none hover:bg-green-600 hint--top-left hint--success hint--rounded hint--bounce" onclick="new()" aria-label="Nuevo registro">
            {{-- <i class="icon-table lg:mr-1"></i> --}}
            <span class="hidden lg:inline-block">Nuevo</span>
        </button>
    </div>
</div>