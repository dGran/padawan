@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} class="my-3 pt-3">
        <ul class="text-xs text-red-500 dark:text-red-400">
            @foreach ($errors->all() as $error)
                <li>
                    <i class="fas fa-exclamation mr-2"></i>
                    <span>{{ $error }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif