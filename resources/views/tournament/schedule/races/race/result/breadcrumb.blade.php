<li class="link">
	<a href="{{ route('tournament.schedule', [$tournament, $season, isset($competition) ? $competition : '', isset($phase) ? $phase : '', isset($group) ? $group : '']) }}"><i class="fas fa-angle-double-left mr-1"></i>Calendario</a>
</li>
<li class="separator"></li>
<li class="current">{{ $race->name }} - Carrera</li>