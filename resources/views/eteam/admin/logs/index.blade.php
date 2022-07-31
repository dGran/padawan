<div>
    <div class="min-w-full">
        <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <table class="min-w-full">
                <thead class="select-none | border-b border-border-color dark:border-edgray-700">
                    @include('eteam.admin.logs.thead')
                </thead>
                <tbody>
                    @include('eteam.admin.logs.tbody')
                </tbody>
            </table>
        </div>
    </div>

    <div class="p-4">
        @include('eteam.admin._paginator')
    </div>
</div>
