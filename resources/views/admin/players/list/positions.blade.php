<option {{ $player_position_id == null ? 'selected' : '' }} value="">Todas</option>
@foreach ($positions as $position)
    <option {{ $player_position_id == $position->id ? 'selected' : '' }} value="{{ $position->id }}">
        {{ $position->name }}
    </option>
@endforeach