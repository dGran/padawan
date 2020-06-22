<form id="form-filter" role="search" method="get" action="{{ route('admin.players_databases') }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.players_databases.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>