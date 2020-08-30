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