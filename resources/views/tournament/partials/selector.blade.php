<div class="selector">
    @if ($tournament->seasons->count() > 1 && $season_selector)
        @include('tournament.partials.season_selector', ['route_name' => $route_name])
    @endif
    @if ($competition_selector)
	    @if ($season->competitions->count() > 1)
	        @include('tournament.partials.competition_selector', ['route_name' => $route_name])
	    @endif
	    @if ($competition->phases->count() > 1)
	        @include('tournament.partials.phase_selector', ['route_name' => $route_name])
	    @endif
	    @if ($phase->groups->count() > 1)
	        @include('tournament.partials.group_selector', ['route_name' => $route_name])
	    @endif
    @endif
</div>