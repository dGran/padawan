@if ($myEteamsRequests->count() > 0)
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b border-border-color dark:border-edgray-700">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Equipo
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Solicita
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Mensaje
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Contrato
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Fecha
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($myEteamsRequests as $request)
                            <tr class="border-b border-border-color dark:border-edgray-700">
                                <td class="px-4 py-2.5 whitespace-nowrap text-sm font-medium">{{ $loop->index+1 }}</td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <x-link href="{{ route('eteams.eteam', $request->eteam->slug) }}">
                                        {{ $request->eteam->name }}
                                    </x-link>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $request->user]))'>
                                        {{ $request->user->name }}
                                    </a>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $request->message ?: '-' }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    -
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $request->created_at->diffForHumans() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center space-x-1.5">
                                        <button type="button" onclick='Livewire.emit("openModal", "modals.accept-eteam-request-confirmation-modal", @json(['eteamRequest' => $request]))' class="w-24 inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Aceptar
                                        </button>

                                        <form method="GET" action="{{ route('myteams.declineRequest', $request) }}">
                                            @csrf
                                            <button type="submit" class="w-24 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                                Rechazar
                                            </button>
                                        </form>
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
    No hay solicitudes recibidas a los equipos que administras
@endif
