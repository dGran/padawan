@if ($notifications->count() > 0)
	@foreach ($notifications as $notification)
		<article class="px-3 border-t border-border-color dark:border-dt-border-color | hover:bg-gray-50 dark:hover:bg-dt-border-color" {{-- wire:click="open({{ $notification->id }})" --}}>
			<div class="flex items-end justify-between space-x-3 pt-2.5 | {{ $notification->read ? 'font-light' : 'font-semibold' }} | text-title-color dark:text-dt-title-color">
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
			    <div class="space-x-1.5">
					<span class="text-xxs md:text-xs" wire:poll.1s>
						{{ $notification->created_at->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }}
					</span>
			    	<x-link wire:click="toggleRead({{ $notification->id }})" class="select-none">
			    		<i class="{{ $notification->read ? 'far' : 'fas' }} fa-file-alt cursor-pointer" title="{{ $notification->read ? 'Marcar como no leido' : 'Marcar como leido' }}"></i>
			    	</x-link>
			    	<x-link color="red" wire:click="delete({{ $notification->id }})" class="select-none" title="Eliminar">
			    		<i class="fas fa-trash cursor-pointer"></i>
			    	</x-link>
			    </div>
			</div>
			<div class="pt-1 pb-2.5">
	            <span class="{{ $notification->read ? 'font-light' : 'font-semibold' }}">
		        	<x-link color="" class="cursor-pointer" wire:click="open({{ $notification->id }})">
						{{ $notification->title }}
					</x-link>
	            </span>
			</div>
		</article>
	@endforeach
@else
	<div class="px-3 py-4 | border-t border-border-color dark:border-dt-border-color | text-center">
		No se han encontrado notificaciones
		{{ $filterUnread ? 'con el filtro aplicado' : '' }}
	</div>
@endif