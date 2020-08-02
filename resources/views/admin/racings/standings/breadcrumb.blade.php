<li><a href="{{ route('admin') }}" class="breadcrumb-link icon-dashboard"></a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li title="Torneos"><a href="{{ route('admin.tournaments') }}" class="breadcrumb-link icon-tournaments mr-2"></a></li>
{{-- <li><span class="breadcrumb-separator">/</span></li> --}}
<li>{{ $tournament->name }} ({{ $tournament->game->name }} - {{ $tournament->game->platform->name }})</li>
<li><span class="breadcrumb-separator">/</span></li>
<li title="Temporadas"><a href="{{ route('admin.seasons', $tournament->slug) }}" class="breadcrumb-link icon-seasons mr-2"></a></li>
<li>{{ $season->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li title="Competiciones"><a href="{{ route('admin.competitions', [$tournament, $season]) }}" class="breadcrumb-link icon-competitions mr-2"></a></li>
<li>{{ $competition->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li title="Fases"><a href="{{ route('admin.phases', [$tournament, $season, $competition]) }}" class="breadcrumb-link icon-phases mr-2"></a></li>
<li>{{ $phase->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li title="Grupos"><a href="{{ route('admin.groups', [$tournament, $season, $competition, $phase]) }}" class="breadcrumb-link icon-groups mr-2"></a></li>
<li>{{ $group->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li>Gestión de carreras</li>