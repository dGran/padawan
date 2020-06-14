<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.platforms.save') }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            @csrf

            <input type="file" name="img" id="img" onchange="showImage(this)" style="display:none"/>
            <input type="hidden" name="deleteImg" id="deleteImg" value=0>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail" src="{{ asset('img/platforms/default.png') }}" alt="img" class="object-cover w-20 h-20 rounded-full border border-gray-500 bg-white p-1">
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

            <div class="mt-8">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg hover:bg-green-600 outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.platforms') }}" class="bg-transparent text-red-500 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>