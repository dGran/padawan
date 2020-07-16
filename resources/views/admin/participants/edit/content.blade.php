<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.participants.update', [$tournament, $season, $participant->id]) }}" lang="{{ app()->getLocale() }}">
            @csrf
            {{ method_field('PUT') }}

            <div class="field-group">
                @if ($tournament->participant_type == 'individual')
                    <div class="element">
                        <label for="user_id">Usuario</label>
                        <div class="relative">
                            <select name="user_id" id="user_id">
                                <option value="">No definido</option>
                                @foreach ($users as $user)
                                    <option {{ $participant->user_id == $user->id || old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($tournament->participant_type == 'eteam')
                    <div class="element">
                        <label for="eteam_id">E-Team</label>
                        <div class="relative">
                            <select name="eteam_id" id="eteam_id">
                                <option value="">No definido</option>
                                @foreach ($eteams as $eteam)
                                    <option {{ $participant->eteam_id == $eteam->id || old('eteam_id') == $eteam->id ? 'selected' : '' }} value="{{ $eteam->id }}">
                                        {{ $eteam->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($tournament->use_teams)
                    <div class="element">
                        <label for="team_id">Equipo</label>
                        <div class="relative">
                            <select name="team_id" id="team_id">
                                <option value="">No definido</option>
                                @foreach ($teams as $team)
                                    <option {{ $participant->team_id == $team->id || old('team_id') == $team->id ? 'selected' : '' }} value="{{ $team->id }}">
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.participants', [$tournament, $season]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>