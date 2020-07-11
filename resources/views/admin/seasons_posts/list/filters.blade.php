<form id="form-filter" role="search" method="get" action="{{ route('admin.seasons_posts', [$tournament, $season]) }}">
	<input type="hidden" name="filtering" value="true"> {{-- field for controller --}}
    @include('admin.seasons_posts.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>