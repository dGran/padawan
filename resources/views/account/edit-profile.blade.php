{{-- breadcrumb --}}
@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <x-link class="" href="{{ route('profile') }}">Mi cuenta</x-link><span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>Editar perfil</span>
    </li>
@endsection


<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
        @include('account.menu', ['activeTab' => 'Account'])

        <div class="w-full">
            <article>
                @include('account.edit-profile.general-data')
            </article>

            <article>
                @include('account.edit-profile.social-data')
            </article>

            <article>
                @include('account.edit-profile.gamer-data')
            </article>
        </div>

    </section>
</x-container>
