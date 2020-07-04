{{-- <option {{ old('seasons') == null ? 'selected' : '' }} value="">*Desconocida</option> --}}
@foreach ($seasons as $season)
    <option value="{{ $season->slug }}">{{ $season->name }}</option>
@endforeach