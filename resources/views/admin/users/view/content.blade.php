<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="bg-white shadow overflow-hidden rounded-lg my-4 flex-1">
    	@if ($user->is_admin)
			<span class="text-sm font-medium py-2 px-3 text-red-500 absolute">ADMIN</span>
    	@endif
		<div class="relative shadow mx-auto h-24 w-24 -my-12 border-white rounded-full overflow-hidden border-4 mt-4">
        	<img class="object-cover w-full h-full" src="{{ $user->profile->avatar() }}">
		</div>
		<div class="mt-16">
			<h1 class="text-lg text-center font-semibold">
				{{ $user->name }}
			</h1>
			<p class="text-sm text-gray-600 text-center pb-4">
				{{ $user->email }}
			</p>
		</div>

		<div>
			<dl>
				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Fecha registro
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d-m-Y / h:s') : 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Fecha nacimiento
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('d-m-Y') : 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Localización
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->location ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						PlayStation ID
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->ps_id ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Xbox ID
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->xbox_id ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Steam ID
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->steam_id ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Origin ID
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->origin_id ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Whatsapp
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->whatsapp ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Facebook
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->facebook ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Instagram
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->instagram ?: 'N/D' }}
					</dd>
				</div>

				<div class="bg-gray-50 px-4 py-5 lg:grid lg:grid-cols-2 lg:gap-8 lg:px-6 border-t border-gray-200 text-center lg:text-left">
					<dt class="text-sm leading-5 font-medium text-gray-500 lg:text-right">
						Twitter
					</dt>
					<dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0">
						{{ $user->profile->twitter ?: 'N/D' }}
					</dd>
				</div>

		    </dl>
		</div>
	</div>
</div>