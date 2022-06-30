@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <x-link class="" href="{{ route('notifications') }}">Notificaciones</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>{{ $notification->title }}</span>
    </li>
@endsection

<x-app-layout title="{{ $notification->title }}" breadcrumb=1 wfooter=0 wloader=0>
    @include('account.menu')
    <x-container class="my-6">
        <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
            <div class="w-full">
                <p>{{ $notification->title }}</p>
                <p>{{ $notification->content }}</p>
            </div>
        </section>
    </x-container>
</x-app-layout>
