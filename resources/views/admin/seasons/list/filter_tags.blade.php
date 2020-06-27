@if ($filterName || $filterGame || $filterParticipantType || $filterMarket)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterGame)
            <button onclick="cancelFilterGame()">{{ $filterGameName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterParticipantType)
            <button onclick="cancelFilterParticipantType()">{{ $filterParticipantType }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterMarket)
            <button onclick="cancelFilterMarket()">con mercado de fichajes<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif