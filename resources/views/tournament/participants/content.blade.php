<div class="content p-2">
    <h2 class="clearfix items-center">
    	<span class="float-left">participantes</span>
    	<i class="fas fa-address-card float-right pl-2 text-20"></i>
    	<i class="fas fa-list-ul float-right text-20"></i>
    </h2>
{{--     <div class="w-full text-right text-22 text-gray-700 pt-2">
		<i class="fas fa-list-ul p-2 bg-white border rounded"></i>
		<i class="fas fa-address-card p-2 bg-white border rounded"></i>
    </div> --}}
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
</div>