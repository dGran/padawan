<h4 class="block | pb-3 | font-semibold | text-title-color dark:text-dt-title-color">
  	Notificaciones
</h4>

<x-card class="p-5 md:p-7 flex flex-col">
	@if ($notifications->count() > 0)
		@foreach ($notifications as $notification)
			<article class="flex items-end justify-between space-x-3 py-2.5 border-b border-border-color dark:border-dt-border-color">
				<p class="text-xs md:text-sm | text-text-light-color">
					{{ $notification->created_at }}
				</p>
			    <div class="flex-auto " x-data="{ open: false }">
			        <button x-on:click="open = ! open">
			            <span class="{{ $notification->read ?: 'font-bold' }}">
			                {{ $notification->title }}
			            </span>
			        </button>
			        <div x-show="open">
			            <p>
			                {!! $notification->content !!}
			            </p>
			        </div>
			    </div>
			    <i class="fas {{ $notification->read ? 'fa-eye' : 'fa-eye-slash' }} cursor-pointer" wire:click="toggleRead({{ $notification->id }})"></i>
			</article>

		@endforeach
	@else
		<div class="">
			No tienes notificaciones
		</div>
	@endif
</x-card>
