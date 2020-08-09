<style>

	.ribbon {
	  position: absolute;
	  left: -5px; top: -5px;
	  z-index: 1;
	  overflow: hidden;
	  width: 75px; height: 75px;
	  text-align: right;
	}
	.ribbon span {
	  font-size: 10px;
	  font-weight: bold;
	  color: #FFF;
	  text-transform: uppercase;
	  text-align: center;
	  line-height: 20px;
	  transform: rotate(-45deg);
	  -webkit-transform: rotate(-45deg);
	  width: 100px;
	  display: block;
	  background: #79A70A;
	  background: linear-gradient(#B6BAC9 0%, #808080 100%);
	  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
	  position: absolute;
	  top: 19px; left: -21px;
	}
	.ribbon span::before {
	  content: "";
	  position: absolute; left: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid #808080;
	  border-right: 3px solid transparent;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
	.ribbon span::after {
	  content: "";
	  position: absolute; right: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid transparent;
	  border-right: 3px solid #808080;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
</style>

<div class="content p-2">
    <h2>calendario</h2>
	@if ($racing->races->count() == 0)
	    <div class="bg-white shadow-md rounded p-4 mt-2 mb-4">
			No existen carreras
	    </div>
	@else
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 pt-4 md:gap-4">
			@foreach ($racing->races as $race)
	            <div class="bg-white rounded p-5 mt-2 mb-4 relative border">
	            	@if ($race->finished())
	            		<div class="ribbon"><span>FINALIZADA</span></div>
	            	@endif

	            	<div class="flex flex-row mb-4">
	            		<div class="flex flex-col border-r pr-2 mr-2 {{ $race->finished() ? 'text-gray-800' : 'text-pink-600' }} font-bold">
	            			<span class="text-center text-4xl font-bold tracking-wide" style="line-height: 1em">
	            				@if (!is_null($race->date))
	            					{{ date('d', strtotime($race->date)) }}
	            				@else
	            					N/D
	            				@endif
	            			</span>
	            			<div class="flex flex-row whitespace-no-wrap justify-center">
	            				<span class="uppercase" style="font-size: 11px">
	            					@if (!is_null($race->date))
	            						{{ date('M', strtotime($race->date)) }} |
	            					@else
	            						N/D
	            					@endif
	            				</span>
	            				<span class="uppercase ml-1" style="font-size: 11px">
	            					@if (!is_null($race->date))
	            						{{ date('H:i', strtotime($race->date)) }}
	            					@else
	            						N/D
	            					@endif
	            				</span>
	            			</div>
	            		</div>
	            		<div class="">
	            			<p class="font-semibold">{{ $race->name }}</p>
	            			<span class="block text-xs text-gray-700">{{ $race->circuit->name }}</span>
	            		</div>
	            	</div>
	            	<div class="">
	            		<img src="{{ $race->circuit->img() }}" alt="{{ $race->circuit->name }}" class="object-cover w-full h-auto rounded shadow-lg" style="{{ $race->finished() ? 'filter: grayscale(100%);' : '' }}">
	            	</div>
	            </div>
			@endforeach
		</div>
	@endif
</div>