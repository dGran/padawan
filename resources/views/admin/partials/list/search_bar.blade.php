<div class="search-bar">
	<div class="flex-initial mr-2">
	    <button type="button" class="add" onclick="add()" aria-label="Nuevo registro">
	        <i class="icon-add lg:mr-1"></i>
	        <span class="hidden lg:inline-block">Nuevo</span>
	    </button>
   </div>

   	<div class="flex-auto mr-2">
	    <div class="search">
	        <span>
	            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg>
	        </span>
	        <input class="search-input placeholder-gray-400" placeholder='Buscar...("/")' name="filterName" id="filterName" value="{{ $filterName }}"/>
	    </div>
	</div>

    <div class="hidden md:block flex-initial mx-3">
        <button type="button" class="shortcuts hint--top-left hint--large hint--rounded hint--info hint--bounce" aria-label='Atajos de teclado: "/" (buscar) - "ALT+F" (ver/ocultar Filtros) - "ALT+T" (ver/ocultar Opciones de Tabla) - "ALT+N" (nuevo registro)'>
            <i class="icon-shortcut"></i>
        </button>
    </div>

    <div class="flex-initial mr-1">
        <button type="button" class="filters" onclick="showHideFilters()">
            <i class="icon-filter lg:mr-1"></i>
            <span class="hidden lg:inline-block">Filtros</span>
        </button>
    </div>

    <div class="flex-initial">
        <button type="button" class="table" onclick="showHideGlobalOptions()">
            <i class="icon-table lg:mr-1"></i>
            <span class="hidden lg:inline-block">Tabla</span>
        </button>
    </div>
</div>