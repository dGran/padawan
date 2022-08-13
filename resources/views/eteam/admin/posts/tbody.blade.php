@if ($data['class']->count() > 0)
    @foreach ($data['class'] as $index => $reg)
        <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent">
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <a href="#" class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $reg->user]))'>
                    {{ $reg->user->name }}
                </a>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <button wire:click="applyVisibilityFilter({{ $reg->public }})" class="text-xxxs uppercase inline-block w-24 py-1.5 px-2.5 leading-none font-medium rounded {{ $reg->public ? 'bg-edgray-400 text-edgray-900 dark:bg-edgray-600 dark:text-white' : 'bg-yellow-600 dark:bg-yellow-700 text-white' }}">
                    {{ $reg->public ? 'pública' : 'privada' }}
                </button>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->title }}
            </td>
            <td class="font-light px-4 py-2.5 flex items-center space-x-1">
                <div x-cloak x-data="{ open: false }">
                    <x-button-link color="edblue" class="group" @click="open = true" title="Ver" wire:click="show({{ $reg->id }})">
                        <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" onclick='Livewire.emit("openModal", "eteam.options.admin.eteam-admin-post-view-modal", @json(['eteamPostId' => $reg->id]))'>
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </x-button-link>
                </div>
                <div x-cloak x-data="{ open: false }">
                    <x-button-link color="edblue" class="group" @click="open = true" title="Ver" wire:click="show({{ $reg->id }})">
                        <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" onclick='Livewire.emit("openModal", "eteam.options.admin.eteam-admin-post-edit-modal", @json(['eteamPostId' => $reg->id]))'>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                    </x-button-link>
                </div>
                <div x-cloak x-data="{ open: false }">
                    <x-button-link color="rose" class="group" @click="open = true" title="Eliminar">
                        <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-rose-500 dark:group-hover:border-rose-400 | group-focus:border-rose-500 dark:group-focus:border-rose-400">
                            <i class="fas fa-trash"></i>
                        </span>
                    </x-button-link>
                    <x-modal>
                        @include('eteam.admin.posts.modals.confirmation-delete')
                    </x-modal>
                </div>
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
