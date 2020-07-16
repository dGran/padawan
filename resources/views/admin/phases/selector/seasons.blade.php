@foreach ($seasons as $season)
    <option value="{{ $season->slug }}">{{ $season->name }}</option>
@endforeach