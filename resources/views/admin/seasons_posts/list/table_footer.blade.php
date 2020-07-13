<span class="text-xs text-gray-900">
    Registros: {{ $seasons_posts->firstItem() }}-{{ $seasons_posts->lastItem() }} de {{ $seasons_posts->total() }}
</span>
<div class="inline-flex mt-2 xs:mt-0">
    {{ $seasons_posts->appends(['perPage' => $perPage, 'filterName' => $filterName, 'filterType' => $filterType, 'order' => $order])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
</div>