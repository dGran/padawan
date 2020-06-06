<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4">
        <form id="frmFilter" role="search" method="get" action="{{ route('admin.users') }}">
            @include('admin.users.list.filters')
        </form>
        @include('admin.users.list.filter_tags')
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto">
        <div class="table-wrap mt-4">
            <table class="admin-tables">
                <thead>
                    @include('admin.users.list.table_header')
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @include('admin.users.list.table_body')
                    @endforeach
                </tbody>
            </table>

            <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                @include('admin.users.list.table_footer')
            </div>
        </div>
    </div>
</div>


<div class="selected-options hidden animated fast">
    @include('admin.partials.list.selected_options',
        [
            'edit'        => 1,
            'view'        => 1,
            'destroy'     => 1,
            'duplicate'   => 1,
            'export'      => 1
        ])
</div>

<div class="global-options hidden animated fast">
    @include('admin.partials.list.global_options',
        [
            'import'      => 1,
            'export'      => 1
        ])
</div>