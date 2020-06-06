<span class="text-xs text-gray-900">
    Registros: {{ $users->firstItem() }}-{{ $users->lastItem() }} de {{ $users->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $users->appends(['perPage' => $perPage, 'filterName' => $filterName, 'sortField' => $sortField, 'sortDirection' => $sortDirection])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>