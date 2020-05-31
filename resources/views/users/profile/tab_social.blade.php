<label class="px-1 text-gray-600 capitalize text-sm" for="whatsapp">
	@if ($profile->whatsapp)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('whatsapp') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Whatsapp Number" name="whatsapp" id="whatsapp" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->whatsapp ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->whatsapp }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-whatsapp"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="facebook">
	@if ($profile->facebook)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('facebook') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Facebook Account" name="facebook" id="facebook" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->facebook ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->facebook }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-facebook"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="instagram">
	@if ($profile->instagram)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('instagram') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Instagram Account" name="instagram" id="instagram" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->instagram ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->instagram }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-instagram"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="twitter">
	@if ($profile->twitter)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('twitter') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Twitter Account" name="twitter" id="twitter" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->twitter ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->twitter }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-twitter"></i>
	</span>
</div>