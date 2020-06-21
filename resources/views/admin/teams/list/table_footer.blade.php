<span class="text-xs text-gray-900">
    Registros: {{ $teams->firstItem() }}-{{ $teams->lastItem() }} de {{ $teams->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $teams->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>