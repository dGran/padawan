<tr data-id="{{ $group->id }}" data-name="{{ $group->name }}" data-slug="{{ $group->slug }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $group->id }}" name="groupId[]" onchange="showHideRowOptionsCustom(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex content-center">
            <i class="fas fa-circle text-base py-3 pr-3 {{ $group->active ? 'text-green-500' : 'text-gray-500' }}"></i>
            <div class="">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                <span class="name">{{ $group->name }}</span>
                <span class="block text-gray-600" style="font-size: 9px">ID:{{ $group->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td>
        {{ $group->num_participants }}
    </td>
</tr>