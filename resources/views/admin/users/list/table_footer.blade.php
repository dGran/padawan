<span class="text-xs text-gray-900">
    Registros: {{ $users->firstItem() }}-{{ $users->lastItem() }} de {{ $users->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $users->appends(['perPage' => $perPage, 'filterName' => $filterName, 'order' => $order, 'filterOnlyAdmin' => $filterOnlyAdmin, 'filterOnlyVerified' => $filterOnlyVerified, 'filterOnlyNotVerified' => $filterOnlyNotVerified])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>