@if ( $filterName || $filterPlayerDatabase || $filterPosition || $filterNation || $filterTeam || $filterLeague || ($filterOverallRangeFrom && $filterOverallRangeTo) || ($filterAgeRangeFrom && $filterAgeRangeTo) || ($filterHeightRangeFrom && $filterHeightRangeTo) || $filterGameID || $filterFoot )
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterPlayerDatabase)
            <button onclick="cancelFilterPlayerDatabase()">{{ $filterPlayerDatabaseName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterPosition)
            <button onclick="cancelFilterPosition()">{{ $filterPositionName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOverallRangeFrom && $filterOverallRangeTo)
            <button onclick="cancelFilterOverallRange()">Media: {{ $filterOverallRangeFrom }}-{{ $filterOverallRangeTo }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterAgeRangeFrom && $filterAgeRangeTo)
            <button onclick="cancelFilterAgeRange()">Edad: {{ $filterAgeRangeFrom }}-{{ $filterAgeRangeTo }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterHeightRangeFrom && $filterHeightRangeTo)
            <button onclick="cancelFilterHeightRange()">Altura: {{ $filterHeightRangeFrom }}-{{ $filterHeightRangeTo }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterNation)
            <button onclick="cancelFilterNation()">{{ $filterNation }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterTeam)
            <button onclick="cancelFilterTeam()">{{ $filterTeam }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterLeague)
            <button onclick="cancelFilterLeague()">{{ $filterLeague }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterFoot)
            <button onclick="cancelFilterFoot()">Pie: {{ $filterFoot }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterGameID)
            <button onclick="cancelFilterGameID()">Game ID: {{ $filterGameID }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif