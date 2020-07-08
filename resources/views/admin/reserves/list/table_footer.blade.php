<span class="text-xs text-gray-900">
    Registros: {{ $reserves->firstItem() }}-{{ $reserves->lastItem() }} de {{ $reserves->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $reserves->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>