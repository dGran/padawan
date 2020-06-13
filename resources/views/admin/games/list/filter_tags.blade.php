@if ($filterName || $filterPlatform || $filterOnlyModeLeague || $filterOnlyModePlayoffs || $filterOnlyModeRaces)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterPlatform)
            <button onclick="cancelFilterPlatform()">{{ $filterPlatformName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyModeLeague)
            <button onclick="cancelFilterOnlyModeLeague()">Solo con modo juego Liga<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyModePlayoffs)
            <button onclick="cancelFilterOnlyModePlayoffs()">Solo con modo juego Playoffs<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyModeRaces)
            <button onclick="cancelFilterOnlyModeRaces()">Solo con modo juego Carreras<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif