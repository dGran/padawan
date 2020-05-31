<label class="px-1 text-gray-600 capitalize text-sm" for="ps_id">
	@if ($profile->ps_id)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('PSN Name') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="PSN Name" name="ps_id" id="ps_id" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->ps_id ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->ps_id }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-playstation"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="xbox_id">
	@if ($profile->xbox_id)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('Xbox Gamertag') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Xbox Gamertag" name="xbox_id" id="xbox_id" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->xbox_id ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->xbox_id }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-xbox"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="steam_id">
	@if ($profile->steam_id)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('Steam Account') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Steam Account" name="steam_id" id="steam_id" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->steam_id ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->steam_id }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-steam"></i>
	</span>
</div>

<label class="px-1 text-gray-600 capitalize text-sm" for="origin_id">
	@if ($profile->origin_id)
		<i class="fas fa-check pr-1 text-green-600"></i>
	@endif
    {{ __('Origin Account') }}
</label>
<div class="relative flex w-full flex-wrap items-stretch mb-4 mt-1">
	<input type="text" placeholder="Origin Account" name="origin_id" id="origin_id" class="px-2 py-2 placeholder-gray-400 text-gray-700 relative {{ $profile->origin_id ? 'bg-white' : 'bg-gray-200' }} focus:bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:border-gray-600 w-full pr-10" value="{{ $profile->origin_id }}"/>
	<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-2 py-2">
		<i class="fab fa-steam"></i>
	</span>
</div>