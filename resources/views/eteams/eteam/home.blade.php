<div class="p-4 md:p-6 lg:p-8">
	<h4 class="text-center text-2xl font-bold text-title-color dark:text-dt-title-color mb-6">
		{{ $eteam->name }}
	</h4>

	@if ($eteam->presentation)
		<p class="text-center pb-4">{!! nl2br($eteam->presentation) !!}</p>
	@endif

	@if ($eteam->presentation_video)
		<div class="flex items-center justify-center">
			<iframe src="https://www.youtube.com/embed/{{ $eteam->presentation_video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full md:max-w-xl h-72 md:h-90 rounded-md"></iframe>
		</div>
	@endif

	<div class="{{ $eteam->presentation || $eteam->presentation_video ? 'mt-4 pt-4 md:mt-6 md:pt-6 | border-t border-border-color dark:border-dt-border-color' : '' }}">
		@if ($eteam->country || $eteam->location)
			<div class="flex flex-col items-center | text-xs md:text-sm">
				<i class="icon-place text-lg mb-1.5 | rounded-full border border-border-color dark:border-dt-border-color | p-1.5"></i>
				@if ($eteam->location)
					<span class="mb-0.5">{{ $eteam->location }}</span>
				@endif
				@if ($eteam->country)
					<div class="flex items-center space-x-1.5">
						<img src="{{ $eteam->country->getFlag24() }}" alt="">
						<span>{{ $eteam->getCountryName() }}</span>
					</div>
				@endif
			</div>
		@endif
		<div class="overflow-x-auto">
			<div class="flex items-center space-x-3 justify-center mt-8">
				@if ($eteam->website)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->website }}" target="_blank" title="Sitio web">
						<i class="icon-website text-xl"></i>
					</a>
				@endif
				@if ($eteam->whatsapp)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{-- {{ $eteam->whatsapp }} --}}" target="_blank" title="Whatsapp">
						<i class="icon-whatsapp text-xl"></i>
					</a>
				@endif
				@if ($eteam->twitter)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->twitter }}" target="_blank" title="Twitter">
						<i class="icon-twitter text-xl"></i>
					</a>
				@endif
				@if ($eteam->facebook)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->facebook }}" target="_blank" title="Facebook">
						<i class="icon-facebook text-xl"></i>
					</a>
				@endif
				@if ($eteam->instagram)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->instagram }}" target="_blank" title="Instagram">
						<i class="icon-instagram text-xl"></i>
					</a>
				@endif
				@if ($eteam->twitch)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->twitch }}" target="_blank" title="Canal Twitch">
						<i class="icon-twitch text-xl"></i>
					</a>
				@endif
				@if ($eteam->youtube)
					<a class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color" href="{{ $eteam->youtube }}" target="_blank" title="Canal Youtube">
						<i class="icon-youtube text-xl"></i>
					</a>
				@endif
			</div>
		</div>
	</div>
</div>