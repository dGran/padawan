<div class="content p-2">
    <h2>normativa</h2>
    <p class="rules-content">
    	@if ($tournament->rules)
    		{!! nl2br(e($tournament->rules)) !!}
    	@endif
    	No se ha definido normativa para este torneo
    </p>
</div>