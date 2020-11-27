<div class="content">

	<div class="match-content">

		<div class="match-title">
			<div class="match-title-banner py-3">
				<div class="text-center text-12 text-gray-400 uppercase">
					{{ $match->day_name() }}
				</div>
				<div class="flex items-start md:items-center">
					<div class="flex-1 local flex flex-col md:flex-row justify-end items-center truncate">
				    	<div class="title md:mr-3 order-last md:order-first pt-1 md:pt-0 leading-4 md:leading-5">
				    		<p class="truncate">{{ $match->local_participant->presenter()['name'] }}</p>
				    		<p class="subname text-11 md:text-13 text-center md:text-right">
				    			{{ $match->local_participant->presenter()['subname'] }}
				    		</p>
				    	</div>
				    	<div class="img">
				    		<img src="{{ $match->local_participant->presenter()['img'] }}" style="height: 3rem; width: 3rem; min-width: 3rem">
				    	</div>
					</div>
					<div class="w-auto result mx-6" style="font-size: 40px">
						{{ $match->result() }}
					</div>
					<div class="flex-1 visitor flex flex-col md:flex-row items-center truncate">
{{-- 				    	<div class="title md:mr-3 order-last md:order-first pt-1 md:pt-0 truncate leading-4 md:leading-5">
				    		{{ $match->local_participant->presenter()['name'] }}
				    		<p class="subname text-11 md:text-13 text-center md:text-right">{{ $match->local_participant->presenter()['subname'] }}</p>
				    	</div> --}}
				    	<div class="img md:mr-3">
				    		<img src="{{ $match->visitor_participant->presenter()['img'] }}" style="height: 3rem; width: 3rem; min-width: 3rem">
				    	</div>
				    	<div class="title pt-1 md:pt-0 truncate leading-4 md:leading-5">
				    		{{ $match->visitor_participant->presenter()['name'] }}
				    		<p class="subname text-11 md:text-13 text-center md:text-left">{{ $match->local_participant->presenter()['subname'] }}</p>
				    	</div>
					</div>
				</div>
			</div>
		</div> {{-- match-title --}}

		<div class="match-menu {{ $tournament->game->platform->color }}">
			<ul>
				<li class="">
					<a href="">
						<i class="far fa-chart-bar"></i>
						<span>Previa</span>
					</a>
				</li>
				<li class="">
					<a href="">
						<i class="fas fa-futbol"></i>
						<span>Partido</span>
					</a>
				</li>
				<li class="">
					<a href="">
						<i class="icon-multimedia"></i>
						<span>Multimedia</span>
					</a>
				</li>
				<li class="">
					<a href="">
						<i class="fas fa-file-signature"></i>
						<span>Reporte</span>
					</a>
				</li>
{{-- 				<li class="{{ Request::route()->getName() == 'tournament.schedule.match.circuit' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.match.circuit', [$tournament, $season, $match->slug]) }}">
						<i class="icon-circuit"></i>
						<span>Circuito</span>
					</a>
				</li>
				<li class="{{ !$match->qualys_finished() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.match.qualy' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.match.qualy', [$tournament, $season, $match->slug]) }}">
						<i class="icon-qualy"></i>
						<span>Calificación</span>
					</a>
				</li>
				<li class="{{ !$match->finished() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.match.result' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.match.result', [$tournament, $season, $match->slug]) }}">
						<i class="icon-match"></i>
						<span>Carrera</span>
					</a>
				</li>
				<li class="{{ !$match->has_media() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.match.multimedia' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.match.multimedia', [$tournament, $season, $match->slug]) }}">
						<i class="icon-multimedia"></i>
						<span>Multimedia</span>
					</a>
				</li> --}}
			</ul>
		</div> {{-- match-menu --}}

	</div> {{-- match-content --}}

</div> {{-- content --}}