<h4 class="block | py-3 md:pt-0 | font-semibold | text-title-color dark:text-dt-title-color">
  	Notificaciones {{ $user->unreadNotifications() == 0 ? '' : '(' . $user->unreadNotifications() . ')' }}
</h4>

<x-card class="flex flex-col">
	<div class="px-3 py-4">
		@include('account.notifications.header')
	</div>

	@include('account.notifications.filters')

	<div class="">
		@include('account.notifications.data')
	</div>

	<div class="px-3 py-4 | border-t border-border-color dark:border-dt-border-color | flex items-center justify-center">
		@include('account.notifications.footer')
	</div>
</x-card>

{{-- temporaly --}}
<x-button wire:click="addNotification" class="mt-4">
	Nueva notificación
</x-button>