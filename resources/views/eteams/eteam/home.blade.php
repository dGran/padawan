<div class="p-4 md:p-6 lg:p-8">
	@if ($eteam->presentation)
		<p class="text-center pb-4">{{ $eteam->presentation }}</p>
	@endif

	@if ($eteam->presentation_video)
		<div class="flex items-center justify-center">
			<iframe src="https://www.youtube.com/embed/{{ $eteam->presentation_video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full md:max-w-xl h-72 md:h-90 rounded-md"></iframe>
		</div>
	@endif

	<ul class="flex flex-col space-y-3 | {{ $eteam->presentation || $eteam->presentation_video ? 'mt-4 pt-4 md:mt-6 md:pt-6 | border-t border-border-color dark:border-dt-border-color' : '' }}">
		<li class="flex items-center">
			<i class="icon-place text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Sede:</span>
			<span>{{ $eteam->location }}</span>
			@if ($eteam->country)
				<img src="{{ $eteam->country->getFlag24() }}" alt="" class="{{ $eteam->location ? 'mx-2' : 'mr-2' }}">{{ $eteam->getCountryName() }}
			@endif
		</li>
		<li class="flex items-center">
			<i class="icon-whatsapp text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Whatsapp:</span>
			<span>{{ $eteam->whatsapp }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-twitter text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Twitter:</span>
			<span>{{ $eteam->twitter }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-facebook text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Facebook:</span>
			<span>{{ $eteam->facebook }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-instagram text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Instagram:</span>
			<span>{{ $eteam->instagram }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-twitch text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Twitch:</span>
			<span>{{ $eteam->twitch }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-youtube text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Youtube:</span>
			<span>{{ $eteam->youtube }}</span>
		</li>
		<li class="flex items-center">
			<i class="icon-website text-lg mr-2"></i>
			<span class="font-semibold | text-title-color dark:text-dt-title-color | mr-2">Website:</span>
			<span>{{ $eteam->website }}</span>
		</li>
	</ul>
</div>