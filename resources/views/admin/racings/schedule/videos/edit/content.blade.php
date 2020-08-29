<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <h3 class="font-bold uppercase text-sm mt-4 pl-2">
            {{ $race->name }} - Editar video
        </h3>
        <div class="form">
            <form id="form-add" method="POST" role="form" action="{{ route('admin.racing.schedule.races.videos.update', [$tournament, $season, $competition, $phase, $group, $race->id, $video->id]) }}" lang="{{ app()->getLocale() }}">
                @csrf
                {{ method_field('PUT') }}

                <div class="field-group">
                    <div class="element">
                        <label for="title">*Título</label>
                        <input type="text" class="placeholder-gray-400" id="title" name="title" placeholder="Título" autofocus value="{{ old('title', $video->title) }}">
                    </div>
                    <div class="element">
                        <label for="provider">Proveedor</label>
                        <div class="relative">
                            <select name="provider" id="provider">
                                <option {{ $video->provider == "youtube" ? 'selected' : '' }} value="youtube">Youtube</option>
                                <option {{ $video->provider == "twitch" ? 'selected' : '' }} value="twitch">Twitch</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <div class="element">
                        <label for="video_id">Video ID</label>
                        <input type="text" class="placeholder-gray-400" id="video_id" name="video_id" placeholder="Título" value="{{ old('video_id', $video->video_id) }}">
                    </div>
                </div>

                <div class="field-group">
                    <div class="element">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" rows="10">{{ $video->description }}</textarea>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                        Guardar
                    </button>
                    <a href="{{ route('admin.racing.schedule.races.videos', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>