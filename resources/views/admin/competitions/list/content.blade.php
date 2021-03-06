<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.competitions.list.filters')
        @include('admin.competitions.list.filter_tags')
    </div>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto mb-2">
        <div class="table-wrap">
            <table class="admin-tables">
                @if ($competitions->count() > 0)
                    <thead>
                        @include('admin.competitions.list.table_header')
                    </thead>
                @endif
                <tbody>
                    @if ($competitions->count() > 0)
                        @foreach ($competitions as $competition)
                            @include('admin.competitions.list.table_body')
                        @endforeach
                    @else
                        @include('admin.partials.list.table_body_empty')
                    @endif
                </tbody>
            </table>
            @if ($competitions->count() > 0)
                <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    @include('admin.competitions.list.table_footer')
                </div>
            @endif
        </div>
    </div>
</div>

<div class="selected-options hidden animated fast">
    @include('admin.competitions.list.selected_options',
        [
            'edit'        => 1,
            'view'        => 1,
            'destroy'     => 1,
            'duplicate'   => 1,
            'export'      => 1
        ])
</div>

<div class="global-options hidden animated fast">
    @include('admin.competitions.list.global_options',
        [
            'import'      => 1,
            'export'      => 1
        ])
</div>