<span class="text-xs text-gray-900">
    Registros: {{ $phases->firstItem() }}-{{ $phases->lastItem() }} de {{ $phases->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $phases->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>