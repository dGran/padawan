<div class="p-4 md:p-6 lg:p-8">
    <div class="overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
        <div class="py-2 inline-block min-w-full">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-b border-border-color dark:border-edgray-700">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Fecha
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Usuario
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Contexto
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Tipo
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Mensaje
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eteam->logs as $log)
                            <tr class="border-b border-border-color dark:border-edgray-700">
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $log->getCreatedAtDate() }} - {{ $log->getCreatedAtTime() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $log->user]))'>
                                        {{ $log->user->name }}
                                    </a>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <span class="text-xxxs uppercase inline-block w-24 py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-medium text-white rounded bg-edgray-600">
                                        {{ $log->context }}
                                    </span>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <span class="text-xxxs uppercase inline-block w-16 py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline
                                                 font-medium text-white rounded
                                                 bg-{{ $log->type === 'post' ? 'green-600' : '' }}
                                                 bg-{{ $log->type === 'update' ? 'yellow-600' : '' }}
                                                 bg-{{ $log->type === 'delete' ? 'red-600' : '' }}"
                                    >
                                        {{ $log->type }}
                                    </span>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $log->message }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
