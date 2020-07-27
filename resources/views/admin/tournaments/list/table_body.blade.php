<tr data-id="{{ $tournament->id }}" data-name="{{ $tournament->name }}" data-slug="{{ $tournament->slug }}" data-one_s = "{{ $tournament->is_one_scpg() ? $tournament->one_scpg()['season'] : '' }}" data-one_sc = "{{ $tournament->is_one_scpg() ? $tournament->one_scpg()['competition'] : '' }}" data-one_scp = "{{ $tournament->is_one_scpg() ? $tournament->one_scpg()['phase'] : '' }}" data-one_scpg = "{{ $tournament->is_one_scpg() ? $tournament->one_scpg()['group'] : '' }}" data-one_mode = "{{ $tournament->is_one_scpg() ? $tournament->one_scpg_mode() : '' }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $tournament->id }}" name="tournamentId[]" onchange="showHideRowOptionsCustom(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <img class="object-cover w-full h-full rounded"
                    src="{{ $tournament->img() }}"
                    alt="" />
            </div>
            <div class="ml-3">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name">{{ $tournament->name }}</span>
                    <span class="block text-gray-600" style="font-size: 9px">ID:{{ $tournament->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td onclick="rowSelect(this)">
        <span>{{ $tournament->game->name }}</span>
        <span class="block text-gray-600" style="font-size: 9px">{{ $tournament->game->platform->name }}</span>
    </td>
    <td onclick="rowSelect(this)" class="hidden xl:table-cell">
        @if ($tournament->participant_type == 'individual')
            <span>Individual</span>
        @else
            <span>E-Teams</span>
        @endif
    </td>
</tr>