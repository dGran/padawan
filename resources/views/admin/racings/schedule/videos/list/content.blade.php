<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <div class="flex-auto">
            <div class="border-b border-gray-400">
				<a href="{{ route('admin.racing.schedule.races.videos.add', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" class="my-3 bg-teal-500 text-white hover:bg-teal-600 active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none" type="button" style="transition: all .15s ease">
					<div class="flex items-center">
						<i class="icon-add mr-3 text-xl"></i>
						<span>Nuevo video</span>
					</div>
				</a>
            </div>
            <h3 class="font-bold uppercase text-sm mt-2 mb-4">
                {{ $race->name }} - Videos
            </h3>
            @if ($race->videos->count() == 0)
	            <div class="bg-white shadow-md rounded-lg p-4 mt-2 mb-4">
					No existen videos
	            </div>
			@else
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
				@foreach ($race->videos as $video)
					<div class="border rounded bg-white">
						<h4 class="bg-gray-100 border-b p-3 rounded-t">
							ID: #{{ $video->id }}
						</h4>
						<p class="p-3">
							<b class="block">Título</b>
							{{ $video->title }}
						</p>
						<div class="px-3">
							<div class="video-container">
								@if ($video->provider == "youtube")
									<iframe src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								@endif
							</div>
						</div>
						<div class="m-3">
							<b class="block">Descripción</b>
							<div class="md:h-32 md:overflow-y-auto">
								@if ($video->description)
									{!! nl2br(e($video->description)) !!}
								@else
									N/D
								@endif
							</div>
						</div>
		                <div class="py-4 text-center mt-4 border-t bg-gray-100 rounded-b">
		                    <button type="button" class="bg-teal-500 text-white active:bg-teal-600 focus:bg-teal-600 hover:bg-teal-600 font-bold uppercase text-xs md:text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease" onclick="edit({{ $video->id }})">
		                        Editar
		                    </button>
		                    <button type="button" class="bg-red-500 text-white active:bg-red-600 focus:bg-red-600 hover:bg-red-600 font-bold uppercase text-xs md:text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease" onclick="destroy({{ $video->id }})">
		                        Eliminar
		                    </button>
		                </div>
					</div>
				@endforeach
				</div>
            @endif
        </div>
    </div>
</div>