<span class="text-xs text-gray-900">
    Registros: {{ $groups->firstItem() }}-{{ $groups->lastItem() }} de {{ $groups->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $groups->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>