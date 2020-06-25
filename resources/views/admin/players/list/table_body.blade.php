<tr data-id="{{ $player->id }}" data-name="{{ $player->name }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $player->id }}" name="playerId[]" onchange="showHideRowOptions(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <img class="object-cover w-full h-full rounded"
                    src="{{ $player->img() }}"
                    alt="" />
            </div>
            <div class="ml-3">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name block">{{ $player->name }}</span>
                    <span class="text-gray-600" style="font-size: 9px">ID:{{ $player->id }}</span>
                    @if ($player->game_id)
                        <span class="text-gray-600" style="font-size: 9px">GAME_ID:{{ $player->game_id }}</span>
                    @endif
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td class="hidden xl:table-cell">
        @if ($player->position)
            {{ $player->position->name }}
        @endif
    </td>
    <td>
        {{ $player->player_database->name }}
        <span class="block text-gray-600" style="font-size: 9px">{{ $player->player_database->game->name }} ({{ $player->player_database->game->platform->name }})</span>
    </td>
</tr>