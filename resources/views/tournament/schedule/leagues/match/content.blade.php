@include('tournament.schedule.leagues.match.menu')

<div class="content">
	<div class="match-content">

		<div class="match-circuit-content pt-4">
			<div class="match-circuit-wrapper">
				<div class="flex-items-center">
			    	<div class="title">
			    		{{ $match->local_participant->presenter()['name'] }}
			    	</div>
			    	<div class="img">
			    		<img src="{{ $match->local_participant->presenter()['img'] }}" alt="">
			    	</div>

				</div>
		    	<div class="content">

			    </div>
			</div>
		</div>

	</div> {{-- match-content --}}

</div> {{-- content --}}