<div class="content p-2">
    <h2 class="clearfix items-center">
    	<span class="float-left">participantes</span>
    	<i class="fas fa-address-card float-right pl-2 text-20"></i>
    	<i class="fas fa-list-ul float-right text-20"></i>
    </h2>

    <div class="participants">
	    @if ($season->participants->count() > 0)
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 py-2">
				@foreach ($season->participants as $participant)
					<div class="card_view p-3 bg-white border rounded hover:bg-yellow-100 text-center relative">
						<figure>
							<img src="{{ $participant->presenter()['img'] }}" alt="{{ $participant->presenter()['name'] }}" class="w-20 h-20 object-cover m-auto shadow border-white border-4 rounded-full" style="{{ $participant->is_free() ? 'filter: grayscale(100%);' : '' }}">
						</figure>
						<p class="pt-1 truncate text-gray-700 font-bold font-roboto-condensed">
							{{ $participant->is_free() ? "LIBRE" : $participant->presenter()['name'] }}
						</p>
						<span class="text-12 font-bold text-gray-500 absolute" style="top: 5px; left: 5px">{{ $loop->iteration }}</span>
					</div>
					<div class="list-view hidden">
						{{ $participant->presenter()['name'] }}
					</div>
				@endforeach
			</div>
		@else
			<div class="p-3 my-2 bg-white border rounded text-center relative text-gray-700 font-bold font-roboto-condensed">
				Lista de participantes vacía
			</div>
		@endif
	</div>

	<div class="reserves mt-4">

	    <h2 class="clearfix items-center">
	    	<span class="float-left">Reservas</span>
	    	<i class="fas fa-address-card float-right pl-2 text-20"></i>
	    	<i class="fas fa-list-ul float-right text-20"></i>
	    </h2>
		@if ($season->reserves->count() > 0)
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 py-2">
				@foreach ($season->reserves as $reserve)
					<div class="card_view p-3 bg-white border rounded hover:bg-yellow-100 text-center relative">
						<figure>
							<img src="{{ $reserve->presenter()['img'] }}" alt="{{ $reserve->presenter()['name'] }}" class="w-20 h-20 object-cover m-auto shadow border-white border-4 rounded-full" style="{{ $reserve->is_free() ? 'filter: grayscale(100%);' : '' }}">
						</figure>
						<p class="pt-1 truncate text-gray-700 font-bold font-roboto-condensed">
							{{ $reserve->is_free() ? "LIBRE" : $reserve->presenter()['name'] }}
						</p>
						<span class="text-12 font-bold text-gray-500 absolute" style="top: 5px; left: 5px">{{ $loop->iteration }}</span>
					</div>
					<div class="list-view hidden">
						{{ $reserve->presenter()['name'] }}
					</div>
				@endforeach
			</div>
		@else
			<div class="p-3 mt-2 bg-white border rounded text-center relative text-gray-700 font-bold font-roboto-condensed">
				Lista de reservas vacía
			</div>
		@endif
	</div>
</div>