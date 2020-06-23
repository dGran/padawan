@if ($filterName || $filterPlayerDatabase)
    <div class="filter-tags">
        @if ($filterPlayerDatabase)
            <button>{{ $filterPlayerDatabaseName }}</button>
        @endif
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif