<span class="text-xs text-gray-900">
    Registros: {{ $tournaments->firstItem() }}-{{ $tournaments->lastItem() }} de {{ $tournaments->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $tournaments->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterParticipantType' => $filterParticipantType, 'filterGame' => $filterGame, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>