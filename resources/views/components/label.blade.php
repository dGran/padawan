@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold pb-1']) }}>
    {{ $value ?? $slot }}
</label>
