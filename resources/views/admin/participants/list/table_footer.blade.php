<span class="text-xs text-gray-900">
    Registros: {{ $seasons->firstItem() }}-{{ $seasons->lastItem() }} de {{ $seasons->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $seasons->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>