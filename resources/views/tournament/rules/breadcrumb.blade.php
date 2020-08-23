<li class="link"><a href="{{ route('home') }}">Padawan</a></li>
<li class="separator"></li>
<li class="link"><a href="{{ route('tournaments') }}">Torneos</a></li>
<li class="separator"></li>
<li class="link"><a href="{{ route('tournament', $tournament) }}">{{ $tournament->name }}</a></li>
<li class="separator"></li>
<li class="current">Normativa</li>