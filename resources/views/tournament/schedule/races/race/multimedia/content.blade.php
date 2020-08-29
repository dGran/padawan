@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content">

{{-- //FALTA CREAR LAS CLASES CSS --}}
		<div class="pt-4">
			@foreach ($race->videos as $video)
				<div class="race-circuit-content">
					<div class="race-circuit-wrapper">
				    	<div class="title">
				    		{{ $video->title }}
				    	</div>
				    	<div class="p-3 border-t">
							<div class="video-container">
								@if ($video->provider == "youtube")
									<iframe src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								@endif
							</div>
							@if ($video->description)
								<p class="pt-3">
									{!! nl2br(e($video->description)) !!}
								</p>
							@endif
				    	</div>
					</div>
				</div>
			@endforeach
		</div>

	</div> {{-- race-content --}}

</div> {{-- content --}}