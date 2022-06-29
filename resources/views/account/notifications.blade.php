<x-app-layout title="Notificaciones" breadcrumb=0 wfooter=0 wloader=0>
    @include('account.menu')
    <x-container class="my-6">
        <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
            <div class="w-full">
                @livewire('account.notification', ['user' => $user])
            </div>
        </section>
    </x-container>
</x-app-layout>
