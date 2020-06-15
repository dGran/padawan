<tr data-id="{{ $position->id }}" data-name="{{ $position->name }}" data-slug="{{ $position->slug }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $position->id }}" name="positionId[]" onchange="showHideRowOptions(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-8 text-center">
                <i class="text-xl text-gray-600 {{ $position->font_icon }}"></i>
            </div>
            <div class="ml-2">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name">{{ $position->name }}</span>
                    <span class="block text-gray-600" style="font-size: 9px">ID:{{ $position->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td onclick="rowSelect(this)">
        {{ $position->category }}
        <span class="block text-gray-600" style="font-size: 9px">ORDEN:{{ $position->order }}</span>
    </td>
    <td>
        <a href="{{ route('admin.games.view', $position->game->id) }}" class="hover:text-blue-500">
            {{ $position->game->name }}
            <span class="block text-gray-600" style="font-size: 9px">{{ $position->game->platform->name }}</span>
        </a>
    </td>
</tr>