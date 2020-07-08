<form id="form-filter" role="search" method="get" action="{{ route('admin.reserves', [$tournament, $season]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.reserves.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>