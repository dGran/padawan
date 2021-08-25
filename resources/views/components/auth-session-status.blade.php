@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'my-3 pt-3 | text-xs text-green-500 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif