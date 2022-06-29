<div>
    <h4 class="flex flex-col | py-3 md:pt-0 | leading-5">
        <span class="text-title-color dark:text-dt-title-color font-semibold">
            Notificaciones {{ $countUnreadNotifications == 0 ? '' : '(' . numberFormatInt($countUnreadNotifications) . ')' }}
        </span>
        <span class="text-xxs | text-text-light-color">Listado equipos e-sports donde eres miembro</span>
    </h4>

    <article>
        <div>
            <x-card class="flex flex-col">
                <div class="px-3 py-4">
                    @include('account.notifications.header')
                </div>

                @include('account.notifications.filters')

                <div class="">
                    @include('account.notifications.data')
                </div>

                <div class="px-3 py-4 | border-t border-border-color dark:border-dt-border-color | flex items-center justify-center">
                    @include('account.notifications.footer')
                </div>
            </x-card>
        </div>

    </article>
</div>
@push('custom-scripts')
    <script>
        window.livewire.on('focus-filter-text', function () {
            $("#filterText").focus();
        });
    </script>
@endpush
