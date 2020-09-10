@if ($tournament->seasons->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.rules', 'season_selector' => true, 'competition_selector' => false])
@endif

<div class="content p-2">
    <h2>normativa</h2>
    <div class="rules-content">
    	@if ($tournament->rules)
    		{!! nl2br(e($tournament->rules)) !!}
    	@else
	    	<div class="empty-view">
	    		No se ha definido normativa
	    	</div>
    	@endif
    </div>
</div>