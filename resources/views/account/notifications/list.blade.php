<div>
    <h4 class="flex flex-col | pt-3 md:pt-0 | leading-5">
        <span class="text-title-color dark:text-dt-title-color font-semibold">
            {{ $countUnreadNotifications == 0 ? '' : '(' . numberFormatInt($countUnreadNotifications) . ')' }} Notificaciones
        </span>
        <span class="text-xxs | text-text-light-color">Listado de notificaciones recibidas</span>
    </h4>

    <article>
        <div>
            <div class="pt-2 pb-4">
                @include('account.notifications.header')
            </div>
            @include('account.notifications.filters')
            <x-card class="flex flex-col | relative bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-dark | rounded-md | shadow-bottom dark:shadow-none">
                @include('account.notifications.data')
            </x-card>
            <div class="py-3 flex items-center justify-end">
                @include('account.notifications.footer')
            </div>
        </div>

    </article>
</div>
@push('custom-scripts')
    <script>
        window.livewire.on('focus-search', function () {
            $("#search").focus();
        });
    </script>
@endpush
