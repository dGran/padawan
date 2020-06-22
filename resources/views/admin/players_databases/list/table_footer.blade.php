<span class="text-xs text-gray-900">
    Registros: {{ $players_databases->firstItem() }}-{{ $players_databases->lastItem() }} de {{ $players_databases->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $players_databases->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>