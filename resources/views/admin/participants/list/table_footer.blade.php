<span class="text-xs text-gray-900">
    Registros: {{ $participants->firstItem() }}-{{ $participants->lastItem() }} de {{ $participants->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $participants->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>