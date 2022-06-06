@if ($myEteamsInvitations->count() > 0)
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
                                Usuario
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
                        @foreach ($myEteamsInvitations as $invitation)
                        <tr class="border-b border-border-color dark:border-edgray-700">
                            <td class="px-4 py-2.5 whitespace-nowrap text-sm font-medium">{{ $loop->index+1 }}</td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <x-link href="{{ route('eteams.eteam', $invitation->eteam->slug) }}">
                                    {{ $invitation->eteam->name }}
                                </x-link>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $invitation->user->name }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                -
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                {{ $invitation->created_at->diffForHumans() }}
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-{{ $invitation->state === 'pending' ? 'yellow' : 'red' }}-600 text-white rounded">
                                    {{ $invitation->state === 'pending' ? 'Pendiente' : 'Rechazado' }}
                                </span>
                            </td>
                            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                <div class="flex items-center space-x-1.5">
                                    <form method="GET" action="{{ route('myteams.declineInvitation', $invitation) }}">
                                        @csrf
                                        <button type="submit" class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xxs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Retirar invitación
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
    No tienes invitaciones pendientes
@endif
