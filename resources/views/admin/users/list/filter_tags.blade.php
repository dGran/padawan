@if ($filterName)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times pl-2"></i></button>
        @endif
    </div>
@endif