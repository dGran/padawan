<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-edit" method="POST" role="form" action="{{ route('admin.users.update', $user->id) }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
    	    {{ method_field('PUT') }}
            @csrf

			<input type="file" name="avatar" id="avatar" value="{{ $user->profile->avatar }}" onchange="showImage(this)" style="display:none"/>
			<input type="hidden" name="deleteAvatar" id="deleteAvatar" value=0>
			<div class="flex flex-row mb-3 rounded justify-center">
				<div class="relative">
					<img id="thumbnail" src="{{ $user->profile->avatar() }}" alt="avatar" class="object-cover w-24 h-24 rounded-full shadow overflow-hidden border-4 border-white">
					<a id="delete_avatar" class="{{ is_null($user->profile->avatar) ? 'hidden' : '' }} absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteImage()" style="top: -5px; right: -10px">
						<i class="fas fa-times"></i>
					</a>
				</div>
			</div>
			<div class="flex flex-row mt-3 mb-1 justify-center">
				<label for="avatar" class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium">
					<i class="fas fa-upload mr-2"></i>Cargar imagen
				</label>
			</div>
			<div class="flex flex-row mt-2 mb-6 text-gray-500 text-xs justify-center">
				<span class="">
					Archivos válidos: .jpeg, .png, .jpg, .gif, .svg
				</span>
			</div>

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name', $user->name) }}">
                </div>
                <div class="element">
                    <label for="password">*Password</label>
                    <input type="password" class="placeholder-gray-400" id="password" name="password" placeholder="Password (mínimo 8 caracteres)" value="{{ $user->password }}">
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="email">*E-mail</label>
                    <input type="email" class="placeholder-gray-400" id="email" name="email" placeholder="Dirección E-Mail" value="{{ old('email', $user->email) }}">
                </div>
                <div class="element">
                    <label for="location">Localización</label>
                    <input type="text" class="placeholder-gray-400" id="location" name="location" placeholder="Localización" value="{{ old('location', $user->profile->location) }}">
                </div>
                <div class="element">
                    <label for="birthdate">Fecha nacimiento</label>
                    <input type="date" class="placeholder-gray-400" id="birthdate" name="birthdate" placeholder="Fecha de nacimiento" value="{{ old('birthdate', $user->profile->birthdate) }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="ps_id">PlayStation ID</label>
                    <input type="text" class="placeholder-gray-400" id="ps_id" name="ps_id" placeholder="Cuenta de PlayStation" value="{{ old('ps_id', $user->profile->ps_id) }}">
                </div>
                <div class="element">
                    <label for="xbox_id">Xbox ID</label>
                    <input type="text" class="placeholder-gray-400" id="xbox_id" name="xbox_id" placeholder="Cuenta de Xbox" value="{{ old('xbox_id', $user->profile->xbox_id) }}">
                </div>
                <div class="element">
                    <label for="steam_id">Steam ID</label>
                    <input type="text" class="placeholder-gray-400" id="steam_id" name="steam_id" placeholder="Cuenta de Steam" value="{{ old('steam_id', $user->profile->steam_id) }}">
                </div>
                <div class="element">
                    <label for="origin_id">Origin ID</label>
                    <input type="text" class="placeholder-gray-400" id="origin_id" name="origin_id" placeholder="Cuenta de Origin" value="{{ old('origin_id', $user->profile->origin_id) }}">
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="number" class="placeholder-gray-400" id="whatsapp" name="whatsapp" placeholder="Número de teléfono de Whatsapp" value="{{ old('whatsapp', $user->profile->whatsapp) }}">
                </div>
                <div class="element">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="placeholder-gray-400" id="twitter" name="twitter" placeholder="Cuenta de twitter" value="{{ old('twitter', $user->profile->twitter) }}">
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="placeholder-gray-400" id="facebook" name="facebook" placeholder="Cuenta de Facebook" value="{{ old('facebook', $user->profile->facebook) }}">
                </div>
                <div class="element">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="placeholder-gray-400" id="instagram" name="instagram" placeholder="Cuenta de Instagram" value="{{ old('instagram', $user->profile->instagram) }}">
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg hover:bg-green-600 outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.users') }}" class="bg-transparent text-red-500 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>