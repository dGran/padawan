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
            <x-card class="w-full p-4">
                @foreach ($notifications as $notification)
                    <div x-data="{ open: false }">
                        <button x-on:click="open = ! open">
                            <span class="{{ $notification->read ?: 'font-bold' }}">
                                {{ $notification->title }}
                            </span>
                        </button>
                        <div x-show="open">
                            <p>
                                {!! $notification->content !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </x-card>
        </div>

    </section>
</x-container>
