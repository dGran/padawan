@if ($filterText || $filterUnread)
	<div class="px-3 mb-1.5 | text-edyellow-600 dark:text-edyellow-400">
		@if ($filterUnread)
			<span class="text-xxs md:text-xs | font-medium">
				Filtro: No leidos
			</span>
		@endif
	</div>
@endif