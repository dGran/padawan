@include('account.menu')

<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
        <div class="w-full">
            <article>
                @include('account.notifications.list')
            </article>
        </div>
    </section>
</x-container>

@push('custom-scripts')
    <script>
       window.livewire.on('focus-filter-text', function () {
            $("#filterText").focus();
        });
    </script>
@endpush
