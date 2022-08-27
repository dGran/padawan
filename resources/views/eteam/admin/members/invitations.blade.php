@if ($invitations->count() > 0)
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
                                Juego
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Usuario
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Invitado por
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Contrato
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
                        @foreach ($invitations as $invitation)
                        <tr class="border-b border-border-color dark:border-edgray-700">
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <div class="flex items-center">
                                        <span
                                            class="flex justify-center rounded-lg bg-gray-200 dark:bg-gray-700 | w-10 px-2 py-1 | font-mono text-xxs font-medium uppercase | border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-600">
                                            {{ $invitation->eteam->short_name }}
                                        </span>
                                    <x-link href="{{ route('eteam', $invitation->eteam->slug) }}" class="ml-2.5">
                                        {{ $invitation->eteam->name }}
                                    </x-link>
                                </div>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $invitation->eteam->game->name }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $invitation->user]))'>
                                    {{ $invitation->user->name }}
                                </a>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $invitation->captain->user]))'>
                                    {{ $invitation->captain->user->name }}
                                </a>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                -
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $invitation->created_at->diffForHumans() }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <div class="flex items-center w-24 bg-{{ $invitation->state === 'pending' ? 'yellow' : 'rose' }}-100 rounded py-0.5 px-1 text-xxs text-{{ $invitation->state === 'pending' ? 'yellow' : 'rose' }}-700 inline-flex items-center" role="alert">
                                    <i class="w-5 fa-solid {{ $invitation->state === 'pending' ? 'fa-triangle-exclamation' : 'fa-ban' }}"></i>
                                    <span>{{ $invitation->state === 'pending' ? 'Pendiente' : 'Rechazada' }}</span>
                                </div>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <div class="flex items-center space-x-1.5">
                                    @if (!$invitation->user->isEteamMember($invitation->eteam_id) && !$invitation->user->isMemberEteamGame($invitation->eteam->game_id) && $invitation->state === 'pending')
                                        <button type="button" onclick='Livewire.emit("openModal", "modals.eteams.retire-eteam-invitation-confirmation-modal", @json(['userId' => $user->id, 'eteamInvitationId' => $invitation->id]))'
                                                class="w-24 inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Retirar
                                        </button>
                                    @else
                                        <div class="flex flex-col space-y-1">
                                            <form method="GET" action="{{ route('my-teams.destroyInvitation', $invitation->id) }}">
                                                @csrf
                                                <button type="submit" class="w-24 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                                    Eliminar
                                                </button>
                                            </form>
                                            @if ($invitation->user->isEteamMember($invitation->eteam_id) || $invitation->user->isMemberEteamGame($invitation->eteam->game_id))
                                                <span class="text-rose-500 text-xxs">
                                                    *{{ $invitation->user->isEteamMember($invitation->eteam_id) ? $invitation->user->name . ' ya es miembro del equipo' : $invitation->user->name . ' ya es miembro de otro equipo del mismo juego' }}
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
    No tienes invitaciones enviadas a los equipos que administras
@endif
