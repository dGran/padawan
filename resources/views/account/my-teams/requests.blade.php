@if ($requests->count() > 0)
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b border-border-color dark:border-edgray-700">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Equipo
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Miembros
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Juego
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Fecha
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Estado
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($requests as $request)
                            <tr class="border-b border-border-color dark:border-edgray-700">
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="flex justify-center rounded-lg bg-gray-200 dark:bg-gray-700 | w-10 px-2 py-1 | font-mono text-xxs font-medium uppercase | border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-600">
                                            {{ $request->eteam->short_name }}
                                        </span>
                                        <x-link href="{{ route('eteams.eteam', $request->eteam->slug) }}" class="ml-2.5">
                                            {{ $request->eteam->name }}
                                        </x-link>
                                    </div>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $request->eteam->users->count() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $request->eteam->game->name }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $request->created_at->diffForHumans() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center w-24 bg-{{ $request->state === 'pending' ? 'yellow' : 'rose' }}-100 rounded py-0.5 px-1 text-xxs text-{{ $request->state === 'pending' ? 'yellow' : 'rose' }}-700 inline-flex items-center" role="alert">
                                        <i class="w-5 fa-solid {{ $request->state === 'pending' ? 'fa-triangle-exclamation' : 'fa-ban' }}"></i>
                                        <span>{{ $request->state === 'pending' ? 'Pendiente' : 'Rechazada' }}</span>
                                    </div>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center space-x-1.5">
                                        @if (!$user->isEteamMember($request->eteam_id) && !$user->isMemberEteamGame($request->eteam->game_id) && $request->state === 'pending')
                                            <button type="button" onclick='Livewire.emit("openModal", "modals.retire-eteam-request-confirmation-modal", @json(['userId' => $user->id, 'eteamRequestId' => $request->id]))'
                                                    class="w-24 inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                Retirar
                                            </button>
                                        @else
                                            <div class="flex flex-col space-y-1">
                                                <form method="GET" action="{{ route('my-teams.destroyRequest', $request->id) }}">
                                                    @csrf
                                                    <button type="submit" class="w-24 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                                        Eliminar
                                                    </button>
                                                </form>
                                                @if ($user->isEteamMember($request->eteam_id) && $user->isMemberEteamGame($request->eteam->game_id))
                                                    <span class="text-rose-500 text-xxs">
                                                        *{{ $user->isEteamMember($request->eteam_id) ? 'ya eres miembro del equipo' : 'ya eres miembro de otro equipo del mismo juego' }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    No tienes solicitudes pendientes
@endif

