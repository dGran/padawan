<div>
    <div class="min-w-full">
        @include('eteam.admin.logs.filters')
        <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <table class="min-w-full">
                <thead class="select-none">
                    @include('eteam.admin.logs.thead')
                </thead>
                <tbody>
                    @include('eteam.admin.logs.tbody')
                </tbody>
            </table>
        </div>
    </div>
    @if ($visiblePaginator)
        @include('eteam.admin.partials.paginator', ['classes' => 'p-4'])
    @endif
</div>

@push('custom-scripts')
    @include('eteam.admin.partials.js.focus-search')
@endpush
