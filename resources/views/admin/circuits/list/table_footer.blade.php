<span class="text-xs text-gray-900">
    Registros: {{ $circuits->firstItem() }}-{{ $circuits->lastItem() }} de {{ $circuits->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $circuits->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>