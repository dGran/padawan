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
                <button wire:click="$set('visibilityFilter', '{{ $reg->public ? 'pública' : 'privada' }}')" class="text-xxxs uppercase inline-block w-24 py-1.5 px-2.5 leading-none font-medium rounded {{ $reg->public ? 'bg-edgray-400 text-edgray-900 dark:bg-edgray-600 dark:text-white' : 'bg-yellow-600 dark:bg-yellow-700 text-white' }}">
                    {{ $reg->public ? 'pública' : 'privada' }}
                </button>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->title }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->content }}
            </td>
            <td class="font-light px-4 py-2.5 flex items-center space-x-1">
                <x-button color="edgray" wire:click="show({{ $reg->id }})" class="w-9 py-1.5 px-2.5 leading-none rounded" title="Ver">
                    <i class="fa-solid fa-eye"></i>
                </x-button>
                <x-button wire:click="edit({{ $reg->id }})" class="w-9 py-1.5 px-2.5 leading-none text-white rounded" title="Editar">
                    <i class="fa-solid fa-pen-to-square"></i>
                </x-button>
                <x-button color='red' wire:click="remove({{ $reg->id }})" class="w-9 py-1.5 px-2.5 leading-none text-white rounded" title="Eliminar">
                    <i class="fa-solid fa-xmark"></i>
                </x-button>
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
