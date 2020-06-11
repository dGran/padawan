{{-- <label class="px-1 text-gray-600 capitalize text-sm" for="avatar">
	@if ($profile->avatar)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('avatar') }}
</label> --}}
<input type="file" name="avatar" id="avatar" value="{{ $profile->avatar }}" onchange="showImage(this)" style="display:none"/>
<input type="hidden" name="deleteAvatar" id="deleteAvatar" value=0>
<div class="flex flex-row mb-3 rounded justify-center">
	<div class="relative">
		<img id="thumbnail" src="{{ $profile->avatar() }}" alt="avatar" class="w-20 h-20 rounded-full border border-gray-500 bg-white p-1">
		<a id="delete_avatar" class="{{ is_null($profile->avatar) ? 'hidden' : '' }} absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteImage()" style="top: -5px; right: -10px">
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

<label class="px-1 text-gray-600 capitalize text-sm" for="birthdate">
	@if ($profile->birthdate)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('Birthdate') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="date" placeholder="Birthdate" name="birthdate" id="birthdate" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->birthdate ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->birthdate }}"/ style="min-height: 39px">
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fas fa-birthday-cake"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="location">
	@if ($profile->location)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('Location') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Location" name="location" id="location" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->location ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->location }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fas fa-map-marker-alt"></i>
	</span>
</div>

<label class="flex justify-start items-start mt-8 text-gray-600 cursor-pointer">
	<div class="bg-white border rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
		<input type="checkbox" class="opacity-0 absolute" {{ $profile->notifications ? 'checked' : '' }} name="notifications">
		<svg class="fill-current hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 20 20" style="padding: 1px"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
	</div>
	<div class="select-none" style="padding-top: 1px">Recibir notificaciones por e-mail</div>
</label>