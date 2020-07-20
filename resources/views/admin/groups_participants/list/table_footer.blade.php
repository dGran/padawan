<span class="text-xs text-gray-900">
    Registros: {{ $groups_participants->firstItem() }}-{{ $groups_participants->lastItem() }} de {{ $groups_participants->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $groups_participants->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>