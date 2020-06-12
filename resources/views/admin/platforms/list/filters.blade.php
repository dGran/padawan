<form id="frmFilter" role="search" method="get" action="{{ route('admin.platforms') }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.platforms.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>