{{-- breadcrumb --}}
@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>Cuenta</span>
    </li>
@endsection


<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
        @include('account.menu')

        <div class="w-full">
            <x-card class="w-full p-5 md:p-7">
                <p>
                    @if (auth()->user()->profile)
                        <div class="flex flex-col items-center">
                            <i class="icon-user text-7xl"></i>
                            <span>{{ auth()->user()->name }}</span>
                            <span>{{ auth()->user()->email }}</span>
                            <span>...</span>
                            <x-link-button class="min-w-max mt-4" href="{{ route('edit-profile') }}">Editar Perfil</x-link-button>
                        </div>
                    @else
                        <i class="icon-user"></i>
                    @endif
                </p>
            </x-card>

        </div>

        {{-- @livewire('account.edit-profile') --}}
    </section>
</x-container>
