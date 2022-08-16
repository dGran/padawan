@if ($data['class']->count() > 0)
    @foreach ($data['class'] as $reg)
        <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent"
            wire:loading.class="opacity-75">
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <a class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer">
                    {{ $reg->user->name }}
                </a>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <button class="text-xxxs uppercase w-24 py-1.5 px-2.5 leading-none bg-{{ $reg->getRangeProps()['color'] }}-400 text-{{ $reg->getRangeProps()['color'] }}-900 dark:bg-{{ $reg->getRangeProps()['color'] }}-600 dark:text-white rounded" wire:click="setRangeFilter('{{ $reg->getRangeProps()['text'] }}')">
                    {{ $reg->getRangeProps()['text'] }}
                </button>
            </td>
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getContractFromDate() ?: 'N/D' }}
            </td>
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getContractToDate() ?: 'N/D' }}
            </td>
            <td class="font-light px-4 py-2.5 flex items-center space-x-1">
                @if ($user->id !== $reg->user->id)
                    @if ($user->isOwnerETeam($eteam->id))
                        @if ($reg->getRangeProps()['text'] === App\Models\ETeamUser::RANGE_CAPTAIN && $reg->getRangeProps()['text'] !== App\Models\ETeamUser::RANGE_OWNER)
                            <x-button-link color="edblue" class="group" title="Transferir propiedad">
                                <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" wire:click="transferTeamOwnership({{ $reg->user->id }})">
                                    <span>P</span>
                                </span>
                            </x-button-link>
                        @else
                            <x-button-link disabled color="edblue" class="group" title="Ascender a capitán">
                                <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
                                    <span>P</span>
                                </span>
                            </x-button-link>
                        @endif
                    @endif
                    @if ($reg->getRangeProps()['text'] === App\Models\ETeamUser::RANGE_MEMBER)
                        <x-button-link color="edblue" class="group" title="Ascender a capitán">
                            <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" wire:click="grantCaptainRange({{ $reg->user->id }})">
                                <span>C</span>
                            </span>
                        </x-button-link>
                    @else
                        <x-button-link disabled color="edblue" class="group" title="Ascender a capitán">
                            <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
                                <span>C</span>
                            </span>
                        </x-button-link>
                    @endif
                    <x-button-link color="rose" class="group" title="Eliminar / Desactivar">
                        <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-rose-500 dark:group-hover:border-rose-400 | group-focus:border-rose-500 dark:group-focus:border-rose-400" wire:click="remove({{ $reg->id }})">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </x-button-link>
                @endif
            </td>
        </tr>
    @endforeach
@else
    <tr class="border-t border-border-color dark:border-edgray-700">
        <td colspan="5" class="text-sm font-light px-4 py-4 whitespace-nowrap text-center">
            No se han encontrado resultados
        </td>
    </tr>
@endif
