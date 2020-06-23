<form id="form-filter" role="search" method="get" action="{{ route('admin.players') }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.players.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>