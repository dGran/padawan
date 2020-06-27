<form id="form-filter" role="search" method="get" action="{{ route('admin.tournaments') }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.tournaments.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>