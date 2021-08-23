@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} class="">
        <ul class="w-auto mx-auto text-xs bg-rose-50 dark:bg-rose-600 border border-rose-600 dark:border-rose-500 text-rose-900 dark:text-rose-100 rounded px-4 py-2 text-center">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif