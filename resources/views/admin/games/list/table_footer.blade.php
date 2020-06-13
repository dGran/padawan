<span class="text-xs text-gray-900">
    Registros: {{ $games->firstItem() }}-{{ $games->lastItem() }} de {{ $games->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $games->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterOnlyModeLeague' => $filterOnlyModeLeague, 'filterOnlyModePlayoffs' => $filterOnlyModePlayoffs, 'filterOnlyModeRaces' => $filterOnlyModeRaces, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>