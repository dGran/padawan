<tr data-id="{{ $season->id }}" data-name="{{ $season->name }}" data-slug="{{ $season->slug }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $season->id }}" name="seasonId[]" onchange="showHideRowOptionsCustom(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        @if ($season->inscription_price > 0)
            <i class="fas fa-donate text-green-500 mr-1 text-xl"></i>
        @endif
        <span class="name">{{ $season->name }}</span>
        <span class="block text-gray-600" style="font-size: 9px">ID:{{ $season->id }}</span>
    </td>
</tr>