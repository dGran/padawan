@if ($filterName || $filterGame || $filterCountry)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterGame)
            <button onclick="cancelFilterGame()">{{ $filterGameName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterCountry)
            <button onclick="cancelFilterCountry()">{{ $filterCountryName }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif