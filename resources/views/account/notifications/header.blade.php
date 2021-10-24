<ul class='flex items-center justify-start space-x-3'>
	<x-input type="text" placeholder="Buscar..." wire:model="filterText" class="w-full" autofocus></x-input>
	<x-button-link class="cursor-pointer" wire:click="toggleFilterUnread" title="{{ $filterUnread ? 'Quitar filtro' : 'Filtro: No leido' }}">
		<span class="flex items-center justify-center rounded-full w-7 h-7 border | {{ !$filterUnread ? 'border-edblue-500 dark:border-edblue-400' : 'border-transparent bg-edblue-500 dark:bg-edblue-400 text-white' }}">
			<i class="fas fa-align-center"></i>
		</span>
	</x-button-link>
	<x-button-link class="cursor-pointer" wire:click="readAll" disabled="{{ $user->unreadNotifications() == 0 }}" title="Marcar todo como leido">
		<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-edblue-500 dark:border-edblue-400">
			<i class="far fa-file-alt"></i>
		</span>
	</x-button-link>
</ul>