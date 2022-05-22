@include('eteams.list.table.navigation')

<div class="my-4 | rounded border border-border-color dark:border-gray-700 | text-sm | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    @if ($eteams->count() > 0)        
        <table class="eteams-table">
            <thead>
                @include('eteams.list.table.thead')
            </thead>
            <tbody>
                @include('eteams.list.table.tbody')
            </tbody>
        </table>
    @else
        @include('eteams.list.table.empty')        
    @endif
</div>