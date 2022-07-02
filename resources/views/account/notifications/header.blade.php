<ul class="flex items-center justify-start space-x-3">
	<div class="relative w-full">
		<x-input type="text" id="search" class="w-full" placeholder="Buscar..." wire:model="search" wire:keydown.escape="$set('search', '')" wire:keydown="applySearch" autofocus></x-input>
		<i class="{{ $search ?: 'hidden' }} fas fa-times | absolute top-0 right-0 | h-full flex items-center | mr-3 | cursor-pointer | text-text-light-color dark:text-dt-text-light-color | hover:text-text-color dark:hover:text-dt-text-color" wire:click="clearSearch"></i>
	</div>
	<x-button-link class="group cursor-pointer" wire:click="toggleUnread" title="{{ $unread ? 'Quitar filtro' : 'Filtro: No leído' }}">
		<span class="flex items-center justify-center rounded-full w-7 h-7 border | {{ !$unread ? 'border-edblue-500 dark:border-edblue-400 | group-hover:border-edblue-600 dark:group-hover:border-edblue-300 | group-focus:border-edblue-600 dark:group-focus:border-edblue-300' : 'border-transparent bg-edblue-500 dark:bg-edblue-400 text-white dark:text-dt-dark | group-hover:bg-edblue-600 dark:group-hover:bg-edblue-300 | group-focus:bg-edblue-600 dark:group-focus:bg-edblue-300' }}">
			<i class="fas fa-folder"></i>
		</span>
	</x-button-link>
    <div x-cloak x-data="{ open: false }">
		<x-button-link class="group cursor-pointer" @click="open = true" disabled="{{ $user->countNotifications() == 0 }}" title="Marcar todo como leído">
			<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-edblue-500 dark:border-edblue-400 | group-hover:border-edblue-600 dark:group-hover:border-edblue-300 | group-focus:border-edblue-600 dark:group-focus:border-edblue-300">
				<i class="far fa-file-alt"></i>
			</span>
		</x-button-link>
        <x-modal>
            @include('account.notifications.modals.confirmation-read-all')
        </x-modal>
    </div>
</ul>
