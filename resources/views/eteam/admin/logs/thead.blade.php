<tr>
    <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
        @if ($order == 'created_at')
            <x-link color="gray" wire:click="setOrder('created_at_desc')" class="group">
                <span>Fecha</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
            </x-link>
        @elseif ($order == 'created_at_desc')
            <x-link color="gray" wire:click="setOrder('created_at')" class="group">
                <span>Fecha</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
            </x-link>
        @else
            <x-link color="gray" wire:click="setOrder('created_at')" class="group">
                <span>Fecha</span>
                <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
            </x-link>
        @endif
    </th>
    <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
        @if ($order == 'user')
            <x-link color="gray" wire:click="setOrder('user_desc')" class="group">
                <span>Usuario</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
            </x-link>
        @elseif ($order == 'user_desc')
            <x-link color="gray" wire:click="setOrder('user')" class="group">
                <span>Usuario</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
            </x-link>
        @else
            <x-link color="gray" wire:click="setOrder('user')" class="group">
                <span>Usuario</span>
                <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
            </x-link>
        @endif
    </th>
    <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
        @if ($order == 'context')
            <x-link color="gray" wire:click="setOrder('context_desc')" class="group">
                <span>Contexto</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
            </x-link>
        @elseif ($order == 'context_desc')
            <x-link color="gray" wire:click="setOrder('context')" class="group">
                <span>Contexto</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
            </x-link>
        @else
            <x-link color="gray" wire:click="setOrder('context')" class="group">
                <span>Contexto</span>
                <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
            </x-link>
        @endif
    </th>
    <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
        @if ($order == 'type')
            <x-link color="gray" wire:click="setOrder('type_desc')" class="group">
                <span>Tipo</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
            </x-link>
        @elseif ($order == 'type_desc')
            <x-link color="gray" wire:click="setOrder('type')" class="group">
                <span>Tipo</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
            </x-link>
        @else
            <x-link color="gray" wire:click="setOrder('type')" class="group">
                <span>Tipo</span>
                <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
            </x-link>
        @endif
    </th>
    <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
        @if ($order == 'message')
            <x-link color="gray" wire:click="setOrder('message_desc')" class="group">
                <span>Mensaje</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-up-short-wide"></i>
            </x-link>
        @elseif ($order == 'message_desc')
            <x-link color="gray" wire:click="setOrder('message')" class="group">
                <span>Mensaje</span>
                <i class="pl-1 w-3 fa-solid fa-arrow-down-short-wide"></i>
            </x-link>
        @else
            <x-link color="gray" wire:click="setOrder('message')" class="group">
                <span>Mensaje</span>
                <i class="pl-1 w-3 fa-solid fa-sort opacity-30 group-hover:opacity-100"></i>
            </x-link>
        @endif
    </th>
</tr>
