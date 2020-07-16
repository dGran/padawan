<span class="text-xs text-gray-900">
    Registros: {{ $competitions->firstItem() }}-{{ $competitions->lastItem() }} de {{ $competitions->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $competitions->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>