@foreach ($logs as $log)
    <tr class="border-b border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent" wire:loading.class="opacity-75">
        <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
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
