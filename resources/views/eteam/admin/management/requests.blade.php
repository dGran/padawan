<div class="border-t border-border-color dark:border-edgray-700 | overflow-x-auto scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    <table class="min-w-full">
        <thead class="border-b border-border-color dark:border-edgray-700">
        <tr>
            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                Fecha
            </th>
            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                Solicita
            </th>
            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                Contrato
            </th>
            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                Acciones
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr class="border-b border-border-color dark:border-edgray-700">
                    <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                        {{ $request->created_at->diffForHumans() }}
                    </td>
                    <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                        <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $request->user]))'>
                            {{ $request->user->name }}
                        </a>
                        @if ($request->message)
                            <a href="#" class="ml-1.5 cursor-pointer text-yellow-500 hover:text-yellow-600 focus:text-yellow-600 dark:hover:text-yellow-400 dark:focus:text-yellow-400 focus:outline-none" onclick='Livewire.emit("openModal", "modals.message-modal", @json(['message' => $request->message]))'>
                                <i class="fa-solid fa-message"></i>
                            </a>
                        @endif
                    </td>
                    <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                        -
                    </td>
                    <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                        <div class="flex items-center space-x-1.5">
                            @if (!$request->user->isEteamMember($request->eteam_id) && !$request->user->isMemberEteamGame($request->eteam->game_id))
                                <button type="button" onclick='Livewire.emit("openModal", "modals.eteams.accept-my-eteam-request-confirmation-modal", @json(['userId' => $user->id, 'eteamRequestId' => $request->id]))'
                                        class="w-24 inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Aceptar
                                </button>
                                <button type="button" onclick='Livewire.emit("openModal", "modals.eteams.decline-my-eteam-request-confirmation-modal", @json(['userId' => $user->id, 'eteamRequestId' => $request->id]))'
                                        class="w-24 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Rechazar
                                </button>
                            @else
                                <div class="flex flex-col space-y-1">
                                    <form method="GET" action="{{ route('my-teams.destroyInvitation', $invitation->id) }}">
                                        @csrf
                                        <button type="submit" class="w-24 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Eliminar
                                        </button>
                                    </form>
                                    <span class="text-rose-500 text-xxs">
                                        *{{ $user->isEteamMember($invitation->eteam_id) ? 'ya eres miembro del equipo' : 'ya eres miembro de otro equipo del mismo juego' }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
