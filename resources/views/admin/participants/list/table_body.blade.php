<tr data-id="{{ $participant->id }}" data-name="{{ $participant->presenter()['name'] }}" data-name_without_team="{{ $participant->name_without_team() }}" data-user_id="{{ $participant->user_id }}" data-eteam_id="{{ $participant->eteam_id }}">
    <td class="select text-center">
        <label class="custom-check">
            <div>
                <input type="checkbox" class="mark" value="{{ $participant->id }}" name="participantId[]" onchange="showHideRowOptionsCustom(this)"/>
                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
            </div>
        </label>
    </td>
    <td onclick="rowSelect(this)">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <img class="object-cover w-full h-full rounded"
                    src="{{ $participant->presenter()['img'] }}"
                    alt="" />
            </div>
            <div class="ml-3">
                {{-- <p class="text-gray-900 whitespace-no-wrap"> --}}
                    <span class="name {{ !$participant->presenter()['defined'] ? 'text-gray-500' : '' }}">{{ $participant->presenter()['name'] }}</span>
                    <span class="block text-gray-600" style="font-size: 9px">ID:{{ $participant->id }}</span>
                {{-- </p> --}}
            </div>
        </div>
    </td>
    @if ($tournament->use_teams)
        <td onclick="rowSelect(this)">
            {{ $participant->name_without_team() }}
        </td>
    @endif
</tr>