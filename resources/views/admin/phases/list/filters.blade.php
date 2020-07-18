<form id="form-filter" role="search" method="get" action="{{ route('admin.phases', [$tournament, $season, $competition]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.phases.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>