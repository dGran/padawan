<div>
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
                        @foreach ($logs as $log)
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

        @if ($logs->lastPage() > 1)
            <div class="flex items-center justify-end | text-xxs md:text-xs | px-0">
                <p class="text-text-light-color | flex items-center space-x-1">
                    <span class="font-medium">{{ $logs->firstItem() }}</span>
                    <span>/</span>
                    <span class="font-medium">{{ $logs->lastItem() }}</span>
                    <span>de</span>
                    <span class="font-medium">{{ $logs->total() }}</span>
                    <span>logs</span>
                </p>
                <div class="pl-3 | flex items-center space-x-0">
                    <button wire:click="previousPage({{ $logs->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-l-md | focus:outline-none">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <select class="appearance-none font-bold | h-9 w-10 px-3 text-center | bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | border-t border-b border-gray-200 dark:border-gray-700 | focus:outline-none | cursor-pointer" wire:model="page" wire:change="setCurrentPage">
                        @for ($i = 1; $i < $logs->lastPage()+1 ; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button wire:click="nextPage({{ $logs->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-r-md | focus:outline-none">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
