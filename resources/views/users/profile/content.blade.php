<div class="custom-container text-gray-800">
    <div class="my-8">
        <div class="flex flex-wrap" id="tabs-id">
        	<div class="w-full md:max-w-lg md:mx-auto">
		        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
		            User Profile
		        </h1>
	        	<div class="flex flex-row items-center my-3">
	        		<div class="flex-col mr-3">
	        			<img src="{{ $profile->avatar() }}" alt="" class="w-20 h-20 rounded-full border border-gray-500 bg-white p-1">
	        		</div>
	        		<div class="flex-col text-gray-700">
			        	<h3 class="text-xl font-bold">{{ $profile->user->name }}</h3>
			        	<span class="block text-sm">{{ $profile->user->email }}</span>
			        	<span class="block text-xs">
			        		{{ $profile->location ? $profile->location : '' }}
			        		{{ $profile->years() && $profile->location ? '- ' : '' }}
			        		{{ $profile->years() }}
			        	</span>
	        		</div>
	        	</div>
		        <div class="overflow-x-auto cursor-pointer">
					<ul class="flex mb-0 list-none pt-3 pb-4 flex-row">
						<li class="flex-auto text-center mr-2">
							<a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-gray-600" onclick="changeAtiveTab(event,'tab-general')">
								<i class="fas fa-id-badge text-base mx-1"></i><span class="mx-1">General</span>
							</a>
						</li>
						<li class="flex-auto text-center mr-2">
							<a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-gray-600 bg-white" onclick="changeAtiveTab(event,'tab-gamer')">
								<i class="fas fa-gamepad text-base mx-1"></i><span class="mx-1">Gamer</span>
							</a>
						</li>
						<li class="flex-auto text-center">
							<a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-gray-600 bg-white" onclick="changeAtiveTab(event,'tab-social')">
								<i class="fas fa-thumbs-up text-base mx-1"></i><span class="mx-1">Social</span>
							</a>
						</li>
					</ul>
		        </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
	        		<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-2">
	        			<div class="px-4 py-5 flex-auto">
	        				<div class="tab-content tab-space">
	        					<div class="block" id="tab-general">
									@include('users.profile.tab_general')
	        					</div>

	        					<div class="hidden" id="tab-gamer">
									@include('users.profile.tab_gamer')
	        					</div>

	        					<div class="hidden" id="tab-social">
									@include('users.profile.tab_social')
	        					</div>
	        				</div>
	        			</div>
	        		</div>
					<button class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all .15s ease">
						Update Profile
					</button>
				</form>
        	</div>
        </div>
    </div>
</div>