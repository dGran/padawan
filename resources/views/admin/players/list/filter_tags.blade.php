@if ($filterName || $filterPlayerDatabase)
    <div class="filter-tags">
        @if ($filterPlayerDatabase)
            <button onclick="cancelFilterPlayerDatabase()">{{ $filterPlayerDatabaseName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif