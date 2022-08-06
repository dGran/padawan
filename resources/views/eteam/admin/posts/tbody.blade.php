@if ($data['class']->count() > 0)
    @foreach ($data['class'] as $reg)
        <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent"
            wire:loading.class="opacity-75">
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $reg->user]))'>
                    {{ $reg->user->name }}
                </a>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <button wire:click="$set('visibilityFilter', '{{ $reg->public ? 'pública' : 'privada' }}')" class="text-xxxs uppercase inline-block w-24 py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-medium text-white rounded bg-edgray-600">
                    {{ $reg->public }}
                </button>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->title }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->content }}
            </td>
            <td>
            </td>
        </tr>
    @endforeach
@else
    <tr class="border-t border-border-color dark:border-edgray-700">
        <td colspan="6" class="text-sm font-light px-4 py-4 whitespace-nowrap text-center">
            No se han encontrado resultados
        </td>
    </tr>
@endif
