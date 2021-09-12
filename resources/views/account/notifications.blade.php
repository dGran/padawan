{{-- breadcrumb --}}
@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>Notificaciones</span>
    </li>
@endsection


<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
        @include('account.menu', ['activeTab' => 'Notifications'])

        <div class="w-full">

        </div>

    </section>
</x-container>
