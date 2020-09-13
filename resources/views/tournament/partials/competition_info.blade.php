@if ($season->competitions->count() > 1)
	<div class="competition-title flex items-center pt-2 pb-4">
		<img src="{{ $competition->img() }}" class="h-20 w-20 inline-block mr-2 object-cover rounded shadow">
		<p class="inline-block text-25 font-bold font-roboto-condensed flex flex-col leading-tight truncate">
			<span class="truncate">{{ $competition->name }}</span>
			@if ($tournament->seasons->count() > 1)
				<span class="text-14 text-gray-700 truncate">{{ $season->name }}</span>
			@endif
			@if ($competition->phases->count() > 1)
				<span class="text-12 text-gray-700 pt-1 truncate">{{ $phase->name }}</span>
			@endif
			@if ($phase->groups->count() > 1)
				<span class="text-12 text-gray-700 truncate">{{ $group->name }}</span>
			@endif
		</p>
	</div>
@endif