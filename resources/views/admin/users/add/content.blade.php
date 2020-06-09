<div class="antialiased font-sans w-full px-4 md:px-8">
	<div class="bg-white rounded shadow border p-6 mt-4">
		<form method="POST" role="form" action="{{ route('admin.users.save') }}" lang="{{ app()->getLocale() }}">
			@csrf
			<div class="inputForm">
				<label for="name">Nombre</label>
				<input type="text" name="name" id="name" placeholder="Nombre" required>
			</div>
			<div class="inputForm mt-3">
				<label for="email">E-Mail</label>
				<input type="email" name="email" id="email" placeholder="E-Mail" required>
			</div>
			<div class="mt-8 mb-4">
				<button type="submit" class="bg-green-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg hover:bg-green-600 outline-none focus:outline-none" style="transition: all .15s ease">
	  				Guardar cambios
				</button>
			</div>
		</form>
	</div>

</div>