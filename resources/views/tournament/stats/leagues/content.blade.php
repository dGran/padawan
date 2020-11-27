@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.stats', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

    <h2>estadísticas</h2>

</div> {{-- content --}}