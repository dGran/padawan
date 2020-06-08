<form id="frmFilter" role="search" method="get" action="{{ route('admin.users') }}">
    @include('admin.users.list.filters_modal')
    @include('admin.partials.list.search_bar')
</form>