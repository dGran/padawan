@auth
	<div class="text-center py-4 bg-gray-800 rounded-b">
		@if (!$eteam->userIsMember())
			@if (!$eteam->userRequest())
        		<form id="form_eteam_user_request" method="POST" role="form" action="{{ route('eteam.user_request', $eteam) }}" lang="{{ app()->getLocale() }}">
        		@csrf
        			<div class="flex flex-col p-3 pb-0 text-left">
	        			<label for="message" class="mb-2">Mensaje (opcional)</label>
	        			<textarea id="message" name="message" rows="5" class="mb-3 rounded text-gray-800 p-3"></textarea>
						<button id="request" type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
						    Solicitar ingreso
						</button>
        			</div>
				</form>
			@else
				<div class="my-2">
					<span class="bg-white border rounded px-3 py-2 text-gray-800">Solicitud enviada, pendiente respuesta del equipo...</span>
				</div>
			@endif
		@endif
		@if ($eteam->userIsMember())
			<a href="#" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
			    Abandonar equipo
			</a>
		@endif
	</div>
@endauth