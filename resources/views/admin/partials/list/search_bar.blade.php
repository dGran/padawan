<div class="search-bar clearfix w-full">
	<div class="actions-1">
	    <button class="add inline-block bg-green-500 text-white border border-green-700 h-full rounded px-3 py-2 focus:outline-none hover:bg-green-600 mr-2" onclick="new()" aria-label="Nuevo registro">
	        <i class="icon-add lg:mr-1"></i>
	        <span class="hidden lg:inline-block">Nuevo</span>
	    </button>
	    <div class="search">
	        <span>
	            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg>
	        </span>
	        <input class="search-input placeholder-gray-400" placeholder='Buscar...("/")' name="filterName" id="filterName" value="{{ $filterName }}"/>
	    </div>
	</div>
    <div class="actions-2">
        <button class="shortcuts hint--top-left hint-medium hint--rounded hint--info hint--bounce" type="button" aria-label='Atajos de teclado: "/" (buscar) - "ALT+F" (ver/ocultar Filtros) - "ALT+T" (ver/ocultar Opciones de Tabla)'>
            <i class="icon-shortcut"></i>
        </button>
        <button class="filters" type="button" onclick="showHideFilters()">
            <i class="icon-filter lg:mr-1"></i>
            <span class="hidden lg:inline-block">Filtros</span>
        </button>
        <button class="table" onclick="showHideGlobalOptions()">
            <i class="icon-table lg:mr-1"></i>
            <span class="hidden lg:inline-block">Tabla</span>
        </button>
    </div>
</div>