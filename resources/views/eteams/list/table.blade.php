<div class="my-4 | rounded border border-border-color dark:border-gray-700 | text-sm">
    @if ($eteams->count() > 0)
        <table class="bg-white dark:bg-dt-dark | w-full | rounded">
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