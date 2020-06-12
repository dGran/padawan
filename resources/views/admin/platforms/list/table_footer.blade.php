<span class="text-xs text-gray-900">
    Registros: {{ $platforms->firstItem() }}-{{ $platforms->lastItem() }} de {{ $platforms->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $platforms->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>