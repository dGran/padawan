<div>
    <div class="min-w-full">
        <p>solicitudes</p>
        <p>invitaciones</p>
        <p>todos los capitanes pueden degradar a otro capitan (degrade)</p>
        @include('eteam.admin.members.filters')
        <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <table class="min-w-full">
                <thead class="select-none">
                    @include('eteam.admin.members.thead')
                </thead>
                <tbody>
                    @include('eteam.admin.members.tbody')
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('custom-scripts')
    @include('eteam.admin.partials.js.focus-search')
    @include('eteam.admin.partials.js.listeners')
@endpush
