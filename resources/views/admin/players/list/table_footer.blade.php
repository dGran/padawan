<span class="text-xs text-gray-900">
    Registros: {{ $players->firstItem() }}-{{ $players->lastItem() }} de {{ $players->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $players->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterPlayerDatabase' => $filterPlayerDatabase, 'filterNation' => $filterNation, 'filterLeague' => $filterLeague, 'filterTeam' => $filterTeam, 'filterPosition' => $filterPosition, 'filterOverallRangeFrom' => $filterOverallRangeFrom, 'filterOverallRangeTo' => $filterOverallRangeTo, 'filterAgeRangeFrom' => $filterAgeRangeFrom, 'filterAgeRangeTo' => $filterAgeRangeTo, 'filterHeightRangeFrom' => $filterHeightRangeFrom, 'filterHeightRangeTo' => $filterHeightRangeTo, 'filterGameID' => $filterGameID, 'filterFoot' => $filterFoot, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>