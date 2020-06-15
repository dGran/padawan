@if ($filterName || $filterCategory || $filterGame)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterCategory)
            <button onclick="cancelFilterCategory()">{{ $filterCategory }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterGame)
            <button onclick="cancelFilterGame()">{{ $filterGameName }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif