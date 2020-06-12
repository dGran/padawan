<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image">
        	<img src="{{ $user->profile->avatar() }}">
		</div>
		<div class="title">
			<h1 class="text-lg font-semibold">
				{{ $user->name }}
			</h1>
			<p class="text-sm text-gray-600 {{ !$user->is_admin ? 'pb-4' : '' }}">
				{{ $user->email }}
			</p>
	    	@if ($user->is_admin)
				<p class="text-sm font-medium pt-2 pb-4 text-red-500">
					ADMIN
				</p>
	    	@endif
		</div>

		<dl>
			<div>
				<dt>Fecha registro</dt>
				<dd>{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d-m-Y / H:i') : 'N/D' }}</dd>
			</div>
			<div>
				<dt>Fecha nacimiento</dt>
				<dd>{{ $user->profile->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('d-m-Y') : 'N/D' }}</dd>
			</div>
			<div>
				<dt>Localización</dt>
				<dd>{{ $user->profile->location ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>PlayStation ID</dt>
				<dd>{{ $user->profile->ps_id ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Xbox ID</dt>
				<dd>{{ $user->profile->xbox_id ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Steam ID</dt>
				<dd>{{ $user->profile->steam_id ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Origin ID</dt>
				<dd>{{ $user->profile->origin_id ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Whatsapp</dt>
				<dd>{{ $user->profile->whatsapp ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Facebook</dt>
				<dd>{{ $user->profile->facebook ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Twitter</dt>
				<dd>{{ $user->profile->twitter ?: 'N/D' }}</dd>
			</div>
			<div>
				<dt>Instagram</dt>
				<dd>{{ $user->profile->instagram ?: 'N/D' }}</dd>
			</div>
	    </dl>

	</div>
</div>