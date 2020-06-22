<tr data-id="{{ $player_database->id }}" data-name="{{ $player_database->name }}" data-slug="{{ $player_database->slug }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $player_database->id }}" name="player_databaseId[]" onchange="showHideRowOptions(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div>
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name">{{ $player_database->name }}</span>
                    <span class="block text-gray-600" style="font-size: 9px">ID:{{ $player_database->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td onclick="rowSelect(this)">
        <span>{{ $player_database->game->name }}</span>
        <span class="block text-gray-600" style="font-size: 9px">{{ $player_database->game->platform->name }}</span>
    </td>
</tr>