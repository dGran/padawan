<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.competitions.save', [$tournament, $season]) }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            @csrf

            <input type="file" name="img" id="img" onchange="showImage(this)" style="display:none"/>
            <input type="hidden" name="deleteImg" id="deleteImg" value=0>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail" src="{{ asset('img/competitions/default.png') }}" alt="img" class="thumbnail">
                    <a id="delete_img" class="hidden absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteImage()" style="top: -5px; right: -10px">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="flex flex-row mt-3 mb-1 justify-center">
                <label for="img" class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium">
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
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                </div>
            </div>

            @if ($tournament->game->mode_league)
                <label class="custom-label flex">
                    <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                        <input type="checkbox" class="hidden" id="auto_generate_league" name="auto_generate_league" {{ old('auto_generate_league') == "on" ? 'checked' : '' }} onchange="auto_generate_league_change()">
                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                    </div>
                    <span class="select-none"><i class="icon-magic text-gray-600 ml-1 mr-2"></i>Generar fase <b>(Liga)</b> y grupo único</span>
                </label>
                <p class="info_auto_generate_league block text-blue-500 text-xs pt-2 pb-4">Marca la casilla para generar automáticamente una fase (modo de juego Liga) con un grupo e inscribir a todos los participantes en êl</p>
            @endif

            @if ($tournament->game->mode_playoffs)
                <label class="custom-label flex">
                    <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                        <input type="checkbox" class="hidden" id="auto_generate_playoff" name="auto_generate_playoff" {{ old('auto_generate_playoff') == "on" ? 'checked' : '' }} onchange="auto_generate_playoff_change()">
                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                    </div>
                    <span class="select-none"><i class="icon-magic text-gray-600 ml-1 mr-2"></i>Generar fase <b>(Eliminatorias)</b> y grupo único</span>
                </label>
                <p class="info_auto_generate_playoff block text-blue-500 text-xs pt-2 pb-4">Marca la casilla para generar automáticamente una fase (modo de juego Eliminatorias) con un grupo e inscribir a todos los participantes en êl</p>
            @endif

            @if ($tournament->game->mode_races)
                <label class="custom-label flex">
                    <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                        <input type="checkbox" class="hidden" id="auto_generate_race" name="auto_generate_race" {{ old('auto_generate_race') == "on" ? 'checked' : '' }}  onchange="auto_generate_race_change()">
                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                    </div>
                    <span class="select-none"><i class="icon-magic text-gray-600 ml-1 mr-2"></i>Generar fase <b>(Carreras)</b> y grupo único</span>
                </label>
                <p class="info_auto_generate_race block text-blue-500 text-xs pt-2 pb-4">Marca la casilla para generar automáticamente una fase (modo de juego Carreras) con un grupo e inscribir a todos los participantes en êl</p>
            @endif


            <div class="pt-4">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.competitions', [$tournament, $season]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>