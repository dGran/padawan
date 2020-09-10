@if ($tournament->seasons->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.participants', 'season_selector' => true, 'competition_selector' => false])
@endif

<div class="content p-2">
    <h2>
    	<span class="flex-none">participantes</span>
    	<ul class="actions flex-1 text-right {{ $season->participants->count() == 0 ? 'hidden' : '' }}">
    		<li id="participants_list_view_button">
		    	<a onclick="participants_change_view('list')"><i class="fas fa-list-ul"></i></a>
    		</li>
    		<li id="participants_card_view_button" class="active">
    			<a onclick="participants_change_view('card')"><i class="fas fa-address-card"></i></a>
    		</li>
    	</ul>
    </h2>

    <div class="participants-content">
	    @if ($season->participants->count() > 0)
			<div id="participants_card_view" class="card-view">
				<ul>
					@foreach ($season->participants as $participant)
						<li class="item">
							<span class="counter">{{ $loop->iteration }}</span>
							<figure>
								<img src="{{ $participant->presenter()['img'] }}" alt="{{ $participant->presenter()['name'] }}" style="{{ $participant->is_free() ? 'filter: grayscale(100%);' : '' }}">
							</figure>
							<p class="name">
								{{ $participant->is_free() ? "LIBRE" : $participant->presenter()['name'] }}
							</p>
						</li>
					@endforeach
				</ul>
			</div>
			<div id="participants_list_view" class="list-view hidden">
				<ul>
					@foreach ($season->participants as $participant)
						<li class="item">
							<span class="counter">{{ $loop->iteration }}</span>
							<figure>
								<img src="{{ $participant->presenter()['img'] }}" alt="{{ $participant->presenter()['name'] }}" style="{{ $participant->is_free() ? 'filter: grayscale(100%);' : '' }}">
							</figure>
							<p class="name">
								{{ $participant->is_free() ? "LIBRE" : $participant->presenter()['name'] }}
							</p>
						</li>
					@endforeach
				</ul>
			</div>
		@else
			<div class="empty-view">
				Lista de participantes vacía
			</div>
		@endif

		{{-- reserves --}}

	    <h2 class="mt-3">
	    	<span class="flex-none">reservas</span>
	    	<ul class="actions flex-1 text-right {{ $season->reserves->count() == 0 ? 'hidden' : '' }}">
	    		<li id="reserves_list_view_button" class="active">
			    	<a onclick="reserves_change_view('list')"><i class="fas fa-list-ul"></i></a>
	    		</li>
	    		<li id="reserves_card_view_button">
	    			<a onclick="reserves_change_view('card')"><i class="fas fa-address-card"></i></a>
	    		</li>
	    	</ul>
	    </h2>

	    @if ($season->reserves->count() > 0)
			<div id="reserves_card_view" class="card-view hidden">
				<ul>
					@foreach ($season->reserves as $reserve)
						<li class="item">
							<span class="counter">{{ $loop->iteration }}</span>
							<figure>
								<img src="{{ $reserve->presenter()['img'] }}" alt="{{ $reserve->presenter()['name'] }}">
							</figure>
							<p class="name">
								{{ $reserve->presenter()['name'] }}
							</p>
						</li>
					@endforeach
				</ul>
			</div>
			<div id="reserves_list_view" class="list-view">
				<ul>
					@foreach ($season->reserves as $reserve)
						<li class="item">
							<span class="counter">{{ $loop->iteration }}</span>
							<figure>
								<img src="{{ $reserve->presenter()['img'] }}" alt="{{ $reserve->presenter()['name'] }}">
							</figure>
							<p class="name">
								{{ $reserve->presenter()['name'] }}
							</p>
						</li>
					@endforeach
				</ul>
			</div>
		@else
			<div class="empty-view">
				Lista de reservas vacía
			</div>
		@endif

	</div> {{-- participants-content --}}
</div> {{-- content --}}