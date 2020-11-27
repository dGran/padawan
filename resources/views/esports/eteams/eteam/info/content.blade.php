<div class="bg-gray-700 text-white">
	<ul>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto">
				<img src="{{ $eteam->img() }}" alt="{{ $eteam->name }}" class="w-24 md:w-32 px-3 py-4 h-auto object-cover mx-auto">
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Nombre
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->name }}</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Nombre corto
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->short_name }}</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Localización
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->location }}</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Juego
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">
						{{ $eteam->game->name }}
					</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Plataforma
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">
						{{ $eteam->game->platform->name }}
					</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Miembros
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->users->count() }}</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Propietario
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->owner->name }}</span>
				</p>
			</div>
		</li>
		<li class="border-t border-gray-800 py-2 px-3">
			<div class="w-full md:w-1/2 justify-center mx-auto clearfix">
				<p class="float-left font-bold text-sm md:text-base">
					Fecha de registro
				</p>
				<p class="float-right">
					<span class="font-medium text-gray-400">{{ $eteam->location }}</span>
				</p>
			</div>
		</li>
	</ul>
</div>