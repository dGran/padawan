<form id="form-filter" role="search" method="get" action="{{ route('admin.users') }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.users.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>