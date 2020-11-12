<div class="bg-gray-100 text-gray-700 rounded-b p-3">
	<ul>
		@foreach ($eteam->players as $player)
			<li>{{ $player->eplayer->user->name }}</li>
		@endforeach
	</ul>
</div>