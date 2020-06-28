@if ($filterName)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif