<form id="form-filter" role="search" method="get" action="{{ route('admin.groups', [$tournament, $season, $competition, $phase]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.groups.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>