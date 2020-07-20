<form id="form-filter" role="search" method="get" action="{{ route('admin.groups_participants', [$tournament, $season, $competition, $phase, $group]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.groups_participants.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>