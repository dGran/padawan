<tr data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-slug="{{ $user->slug }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $user->id }}" name="userId[]" onchange="showHideRowOptions(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <img class="object-cover w-full h-full rounded-full"
                    src="{{ $user->profile->avatar() }}"
                    alt="" />
            </div>
            <div class="ml-3">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name">{{ $user->name }}</span>
                    <span class="block text-gray-600" style="font-size: 9px">ID:{{ $user->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    <td class="hidden lg:table-cell" onclick="rowSelect(this)">
        {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
            <i class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
            <i class="fas fa-clock mx-1"></i>{{ \Carbon\Carbon::parse($user->created_at)->format('H:i') }}
        {{-- </p> --}}
    </td>
</tr>