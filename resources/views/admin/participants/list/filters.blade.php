<form id="form-filter" role="search" method="get" action="{{ route('admin.participants', [$tournament, $season]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.participants.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>