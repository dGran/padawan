@if ($filterName || $filterType)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterType)
            <button onclick="cancelFilterType()">
            	@if ($filterType == 'default')
            		Tipo: regular
            	@endif
                @if ($filterType == 'participation')
                    Tipo: participación
                @endif
            	@if ($filterType == 'result')
            		Tipo: resultados
            	@endif
            	@if ($filterType == 'transfer')
            		Tipo: fichajes
            	@endif
            	@if ($filterType == 'press')
            		Tipo: prensa
            	@endif
            	@if ($filterType == 'champion')
            		Tipo: campeones
            	@endif
            	<i class="fas fa-times"></i>
            </button>
        @endif
    </div>
@endif