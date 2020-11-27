@auth
	<div class="text-center py-4 bg-gray-800 rounded-b">
		@if (!$eteam->userIsMember())
			<button id="request" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
			    Solicitar ingreso
			</button>
		@endif
		@if ($eteam->userIsMember())
			<a href="#" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
			    Abandonar equipo
			</a>
		@endif
	</div>
@endauth