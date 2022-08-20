@forelse ($data['class'] as $reg)
    <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent">
        <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
            {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
        </td>
        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
            <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" wire:click="applyUserFilter('{{ $reg->user->name }}')">
                {{ $reg->user->name }}
            </a>
        </td>
        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
            <button wire:click="applyContextFilter('{{ $reg->context }}')" class="text-xxxs uppercase w-24 py-1.5 px-2.5 leading-none bg-edgray-400 text-edgray-900 dark:bg-edgray-600 dark:text-white rounded">
                {{ $reg->context }}
            </button>
        </td>
        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
            <button wire:click="applyTypeFilter('{{ $reg->type }}')"
                class="text-xxxs uppercase inline-block w-16 py-1.5 px-2.5 leading-none text-white rounded
                bg-{{ $reg->type === 'post' ? 'green-600' : '' }}
                bg-{{ $reg->type === 'update' ? 'yellow-600' : '' }}
                bg-{{ $reg->type === 'delete' ? 'red-600' : '' }}"
            >
                {{ $reg->type }}
            </button>
        </td>
        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
            {{ $reg->message }}
        </td>
    </tr>
@empty
    <tr class="border-t border-border-color dark:border-edgray-700">
        <td colspan="5" class="text-sm font-light px-4 py-4 whitespace-nowrap text-center">
            No se han encontrado resultados
        </td>
    </tr>
@endforelse
