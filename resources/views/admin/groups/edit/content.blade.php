<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.groups.update', [$tournament, $season, $competition, $phase, $group->id]) }}" lang="{{ app()->getLocale() }}">
            @csrf
            {{ method_field('PUT') }}

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name', $group->name) }}">
                </div>
                <div class="element">
                    <label for="num_participants">*Participantes</label>
                    <input type="number" class="placeholder-gray-400" id="num_participants" name="num_participants" placeholder="Número de participantes" min="{{ $group->participants->count() }}" max="{{ $group->max_participants() }}" value="{{ old('num_participants', $group->num_participants) }}">
                        <div class="pt-2">
                            @if ($group->participants->count() > 0)
                                <p class="block text-blue-500 text-xs">Mínimo: {{ $group->participants->count() }} (participantes registrados)</p>
                            @endif
                            <p class="block text-blue-500 text-xs">Máximo: {{ $group->max_participants() }}</p>
                        </div>
                    </p>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.groups', [$tournament, $season, $competition, $phase]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>