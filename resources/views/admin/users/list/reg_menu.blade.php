<ul class="bg-white rounded shadow mt-1 text-xs font-semibold text-left text-gray-700">
	<li>
		<span class="block px-4 py-2 font-semibold bg-pink-500 text-white rounded-t">
			{{ $user->name }}
		</span>
	</li>
	<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200">
		<a class="block px-4 py-2 border-l-2 border-transparent hover:border-pink-500 focus:border-pink-500 hover:text-pink-500 focus:text-pink-500 focus:outline-none" href="{{ route('profile') }}">
			Editar
		</a>
	</li>
	@admin(auth()->user())
		<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200">
			<a class="block px-4 py-2 border-l-2 border-transparent hover:border-pink-500 focus:border-pink-500 hover:text-pink-500 focus:text-pink-500 focus:outline-none" href="{{ route('home') }}">
				Eliminar
			</a>
		</li>
	@endadmin

	{{-- last-item --}}
	<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200 rounded-b">
		<a class="block px-4 py-2 border-l-2 border-transparent hover:border-pink-500 focus:border-pink-500 hover:text-pink-500 focus:text-pink-500 focus:outline-none rounded-b" href="{{ route('logout') }}">
			Duplicar
		</a>
	</li>
</ul>