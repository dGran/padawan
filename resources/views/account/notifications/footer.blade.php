<div class="flex items-start">
	<div class="text-xxs md:text-xs">
		Registros: {{ $notifications->count() }} de {{ $notifications->count() }}
	</div>

	<div class="text-xs md:text-sm">
		{{ $notifications->links() }}
	</div>
</div>