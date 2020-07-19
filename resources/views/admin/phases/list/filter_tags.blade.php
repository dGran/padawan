@if ($filterName || $filterMode)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterMode)
            <button onclick="cancelFilterMode()">
            	@if ($filterMode == "league")
            		Modo: Liga
            	@endif
            	@if ($filterMode == "playoff")
            		Modo: Eliminatorias
            	@endif
            	@if ($filterMode == "race")
            		Modo: Carreras
            	@endif
            	<i class="fas fa-times"></i>
            </button>
        @endif
    </div>
@endif