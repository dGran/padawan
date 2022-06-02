{{-- breadcrumb --}}
@section('breadcrumb')
    <li class="min-w-max">
        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link>
        <span class="px-1.5">/</span>
    </li>
    <li class="min-w-max">
        <span>Mis Equipos</span>
    </li>
@endsection


<x-container>
    <section class="mb-8 flex flex-col md:flex-row justify-between items-start gap-4 md:gap-8">
        @include('account.menu', ['activeTab' => 'MyTeams'])

        <div class="w-full flex flex-col sm:flex-row items-start justify-between space-y-4 sm:space-x-8 sm:space-y-0">
            <div class="w-full">
                <h4 class="text-base md:text-lg | font-semibold | text-title-color dark:text-dt-title-color">
                    Invitaciones recibidas
                </h4>
                @if ($invitations->count() > 0)
                    @foreach ($invitations as $invitation)
                        <div class="flex flex-col py-1.5">
                            <div
                                class="rounded-md | bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color">
                                <div class="w-full | p-3 | flex flex-col items-center">
                                    <img src="{{ $invitation->eteam->getLogo() }}" alt=""
                                         class="w-12 h-12 object-cover rounded-full | border border-border-color dark:border-dt-border-color">
                                    <x-link href="{{ route('eteams.eteam', $invitation->eteam->slug) }}">
                                        {{ $invitation->eteam->name }}
                                    </x-link>
                                    <p class="text-xxxs md:text-xxs | mt-1">
                                        Invitado por
                                        <x-link>{{ $invitation->captain->user->name }}</x-link>
                                    </p>
                                </div>
                                <div
                                    class="w-full | p-3 | flex items-center justify-center space-x-3 | border-t border-border-color dark:border-dt-border-color">
                                    <x-button color="red" class="w-24">
                                        <span class="text-xs">Rechazar</span>
                                    </x-button>
                                    <x-button class="w-24">
                                        <span class="text-xs">Aceptar</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    No tienes invitaciones pendientes
                @endif
            </div>

            <div class="w-full">
                <h4 class="text-base md:text-lg | font-semibold | text-title-color dark:text-dt-title-color">
                    Solicitudes recibidas
                </h4>
                @if ($myEteamsRequests->count() > 0)
                    @foreach ($myEteamsRequests as $request)
                        <div class="flex flex-col py-1.5">
                            <div
                                class="rounded-md | bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color">
                                <div class="w-full | p-3 | flex flex-col items-center">
                                    <img src="{{ $request->eteam->getLogo() }}" alt=""
                                         class="w-12 h-12 object-cover rounded-full | border border-border-color dark:border-dt-border-color">
                                    <x-link href="{{ route('eteams.eteam', $request->eteam->slug) }}">
                                        {{ $request->eteam->name }}
                                    </x-link>
                                    <p class="text-xxxs md:text-xxs | mt-1">
                                        Solicita:
                                        <x-link>{{ $request->user->name }}</x-link>
                                    </p>
                                </div>
                                <div
                                    class="w-full | p-3 | flex items-center justify-center space-x-3 | border-t border-border-color dark:border-dt-border-color">
                                    <x-button color="edblue" class="w-40">
                                        <span class="text-xs">Aceptar solicitud</span>
                                    </x-button>
                                    <x-button color="rose" class="w-40">
                                        <span class="text-xs">Rechazar solicitud</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    No tienes solicitudes pendientes
                @endif

                @if ($requests->count() > 0)
                    <h4 class="text-base md:text-lg | font-semibold | text-title-color dark:text-dt-title-color">
                        Solicitudes enviadas
                    </h4>
                    @foreach ($requests as $request)
                        <div class="flex flex-col py-1.5">
                            <div
                                class="rounded-md | bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color">
                                <div class="w-full | p-3 | flex flex-col items-center">
                                    <img src="{{ $request->eteam->getLogo() }}" alt=""
                                         class="w-12 h-12 object-cover rounded-full | border border-border-color dark:border-dt-border-color">
                                    <x-link href="{{ route('eteams.eteam', $request->eteam->slug) }}">
                                        {{ $request->eteam->name }}
                                    </x-link>
                                </div>
                                <div
                                    class="w-full | p-3 | flex items-center justify-center space-x-3 | border-t border-border-color dark:border-dt-border-color">
                                    <x-button color="edgray" class="w-40">
                                        <span class="text-xs">Retirar solicitud</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


    </section>
</x-container>
