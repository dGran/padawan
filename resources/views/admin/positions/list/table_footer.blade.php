<span class="text-xs text-gray-900">
    Registros: {{ $positions->firstItem() }}-{{ $positions->lastItem() }} de {{ $positions->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $positions->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterCategory' => $filterCategory, 'filterGame' => $filterGame, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>