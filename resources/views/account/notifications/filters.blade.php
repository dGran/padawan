@if ($filterText || $filterUnread)
	@if ($filterUnread)
		<div class="px-3 mb-1.5 | text-edyellow-600 dark:text-edyellow-400">
			<span class="text-xxs md:text-xs | font-semibold">
				Filtro: No leidos
			</span>
		</div>
	@endif
@endif