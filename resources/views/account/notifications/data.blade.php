@if ($notifications->count() > 0)
	@foreach ($notifications as $notification)
		<article class="px-3 border-t border-border-color dark:border-dt-border-color | hover:bg-gray-50 dark:hover:bg-dt-border-color" {{-- wire:click="open({{ $notification->id }})" --}}>
			<div class="flex items-end justify-between space-x-3 pt-2.5 | {{ $notification->read ? 'font-light opacity-70' : 'font-semibold' }} | text-title-color dark:text-dt-title-color">
				<p>
		        	@if ($notification->fromUser)
			        	<x-link class="cursor-pointer" wire:click="$emit('openModal', 'modals.user-modal', {{ json_encode([$notification->fromUser]) }})">
				        	<span class="{{ $notification->read ? 'hidden' : '' }}">
				        		<i class="fas fa-caret-right"></i>
				        	</span>
							De: {{ $notification->fromUser->name }}
						</x-link>
					@else
						<span>
		        			<span class="{{ $notification->read ? 'hidden' : '' }}">
				        		<i class="fas fa-caret-right"></i>
				        	</span>
							De: {{ config('app.name') }}
						</span>
		        	@endif
				</p>
			    <div class="flex flex-col">
					<span class="text-xxxs md:text-xxs" wire:poll.1s>
						{{ $notification->created_at->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }}
					</span>
			    </div>
			</div>
			<div class="flex flex-col sm:flex-row items-start justify-between space-x-1.5">
				<div class="pt-1.5 pb-2.5 px-1.5">
		            <span class="{{ $notification->read ? 'font-light opacity-70' : 'font-semibold' }}">
			        	<x-link color="" class="cursor-pointer" wire:click="open({{ $notification->id }})">
							{{ $notification->title }}
						</x-link>
		            </span>
				</div>
				<div class="w-full sm:w-auto flex items-center justify-end space-x-1.5 | pb-2.5 sm:py-2.5">
					<x-button-link class="group cursor-pointer" wire:click="open({{ $notification->id }})" title="Abrir">
						<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
							<i class="fas fa-eye"></i>
						</span>
					</x-button-link>
					<x-button-link class="group cursor-pointer" wire:click="toggleRead({{ $notification->id }})" title="{{ $notification->read ? 'Marcar como no leido' : 'Marcar como leido' }}">
						<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400">
							<i class="{{ $notification->read ? 'far' : 'fas' }} fa-file-alt"></i>
						</span>
					</x-button-link>
					<x-button-link color="red" class="group cursor-pointer" wire:click="delete({{ $notification->id }})" title="Eliminar">
						<span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-red-500 dark:group-hover:border-red-400 | group-focus:border-red-500 dark:group-focus:border-red-400">
							<i class="fas fa-trash"></i>
						</span>
					</x-button-link>
				</div>
			</div>
		</article>
	@endforeach
@else
	<div class="px-3 py-4 | border-t border-border-color dark:border-dt-border-color | text-center">
		No se han encontrado resultados
		{{ $filterText || $filterUnread ? 'con el filtro aplicado' : '' }}
	</div>
@endif