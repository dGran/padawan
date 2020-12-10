<div class="bg-gray-100 text-gray-700 rounded-b p-3">
{{-- 	menu de administracion
	<ul>
		<li>Solicitudes enviadas : {{ $eteam->requests }}</li>
		<li>Solicitudes recibidas : {{ $eteam->requests }}</li>
	</ul> --}}

	<h4 class="font-bold text-21 mb-2">
		Solicitudes recibidas
	</h4>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-2">
		@foreach($requestsReceived as $request)
			<div>
				<div class="border rounded bg-white flex flex-col">
					<div class="pt-1 px-3 mt-3"><span class="font-bold">Fecha:</span> {{ $request->created_at }}</div>
					<div class="pt-1 px-3"><span class="font-bold">Usuario:</span> {{ $request->user->name }}</div>
					@if ($request->message)
						<div class="pt-1 px-3">
							<span class="block font-bold">Mensaje</span>
							{{-- <textarea readonly rows="5" class="w-full mt-1 border rounded p-2">{{  $request->message }}</textarea> --}}
							<div class="text-gray-600 pl-4 py-1">
								"{!! nl2br($request->message) !!}"
							</div>
						</div>
					@endif
					<div class="border-t border-gray-300 p-3 mt-3">
						<a href="#" class="inline-flex items-center px-2 py-1 text-xs bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
						    Aceptar
						</a>
						<a href="#" class="inline-flex items-center px-2 py-1 text-xs bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
						    Declinar
						</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<h4 class="font-bold text-21 mt-4 mb-2">
		Solicitudes enviadas
	</h4>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-2">
		@foreach($requestsSent as $request)
			<div>
				<ul class="border rounded p-3 bg-white">
					<li class="py-1"><span class="font-bold">Fecha:</span> {{ $request->created_at }}</li>
					<li class="py-1"><span class="font-bold">Usuario:</span> {{ $request->user->name }}</li>
					@if ($request->message)
						<li class="py-1">
							<span class="block font-bold">Mensaje</span>
							<textarea readonly rows="5" class="w-full mt-1 border rounded p-2">{{  $request->message }}</textarea>
						</li>
					@endif
					<a href="#" class="inline-flex items-center px-2 py-1 text-xs bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
					    Cancelar solicitud
					</a>
				</ul>
			</div>
		@endforeach
	</div>


{{-- 	<h4>
		Enviar solicitud de ingreso
	</h4> --}}

</div>