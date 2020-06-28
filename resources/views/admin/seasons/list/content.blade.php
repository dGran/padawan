<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.seasons.list.filters')
        @include('admin.seasons.list.filter_tags')
    </div>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto mb-2">
        <div class="table-wrap">
            <table class="admin-tables">
                @if ($seasons->count() > 0)
                    <thead>
                        @include('admin.seasons.list.table_header')
                    </thead>
                @endif
                <tbody>
                    @if ($seasons->count() > 0)
                        @foreach ($seasons as $season)
                            @include('admin.seasons.list.table_body')
                        @endforeach
                    @else
                        @include('admin.partials.list.table_body_empty')
                    @endif
                </tbody>
            </table>
            @if ($seasons->count() > 0)
                <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    @include('admin.seasons.list.table_footer')
                </div>
            @endif
        </div>
    </div>
</div>


<div class="selected-options hidden animated fast">
    @include('admin.seasons.list.selected_options',
        [
            'edit'        => 1,
            'view'        => 1,
            'destroy'     => 1,
            'duplicate'   => 1,
            'export'      => 1
        ])
</div>

<div class="global-options hidden animated fast">
    @include('admin.seasons.list.global_options',
        [
            'import'      => 1,
            'export'      => 1
        ])
</div>