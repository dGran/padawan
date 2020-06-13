@if ($filterName || $filterOnlyAdmin || $filterOnlyVerified || $filterOnlyNotVerified)
    <div class="filter-tags">
        @if ($filterName)
            <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyAdmin)
            <button onclick="cancelFilterOnlyAdmin()">Sólo admins<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyVerified)
            <button onclick="cancelFilterOnlyVerified()">Sólo verificados<i class="fas fa-times"></i></button>
        @endif
        @if ($filterOnlyNotVerified)
            <button onclick="cancelFilterOnlyNotVerified()">Sólo no verificados<i class="fas fa-times"></i></button>
        @endif
    </div>
@endif