@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content pb-6">

		@foreach ($race->videos as $video)
			<div class="race-multimedia-content">
				<div class="race-multimedia-wrapper">
			    	<div class="title">
			    		{{ $video->title }}
			    	</div>
			    	<div class="content">
						<div class="video-container">
							@if ($video->provider == "youtube")
								<iframe src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							@endif
						</div>
						@if ($video->description)
							<p class="description">
								{!! nl2br(e($video->description)) !!}
							</p>
						@endif
			    	</div>
				</div>
			</div>
		@endforeach

	</div> {{-- race-content --}}

</div> {{-- content --}}