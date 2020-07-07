@if ($filterName || $filterReserve)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterReserve)
            <button onclick="cancelFilterReserve()">Sólo reservas<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif