<li class="link"><a href="{{ route('home') }}">Padawan</a></li>
<li class="separator"></li>
<li class="link"><a href="{{ route('tournaments') }}">Torneos</a></li>
<li class="separator"></li>
<li class="link"><a href="{{ route('tournament', [$tournament, $season]) }}">{{ $tournament->name }}</a></li>
<li class="separator"></li>
<li class="current">Clasificación</li>

{{-- <li class="link">
	<a href="{{ route('tournament', $tournament) }}"><i class="fas fa-angle-double-left mr-1"></i>{{ $tournament->name }}</a>
</li> --}}