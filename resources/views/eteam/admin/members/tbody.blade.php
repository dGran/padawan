@if ($data['class']->count() > 0)
    @foreach ($data['class'] as $reg)
        <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent"
            wire:loading.class="opacity-75">
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer">
                    {{ $reg->user->name }}
                </a>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <button wire:click="setRangeFilter('{{ $reg->getRangeProps()['text'] }}')" class="text-xxxs uppercase w-24 py-1.5 px-2.5 leading-none bg-{{ $reg->getRangeProps()['color'] }}-400 text-{{ $reg->getRangeProps()['color'] }}-900 dark:bg-{{ $reg->getRangeProps()['color'] }}-600 dark:text-white rounded">
                    {{ $reg->getRangeProps()['text'] }}
                </button>
            </td>
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getContractFromDate() }}
            </td>
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getContractToDate() }}
            </td>
            <td></td>
        </tr>
    @endforeach
@else
    <tr class="border-t border-border-color dark:border-edgray-700">
        <td colspan="5" class="text-sm font-light px-4 py-4 whitespace-nowrap text-center">
            No se han encontrado resultados
        </td>
    </tr>
@endif
