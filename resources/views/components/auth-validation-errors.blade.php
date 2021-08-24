@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} class="">
        <ul class="text-xs text-red-500 dark:text-red-400 rounded">
            @foreach ($errors->all() as $error)
                <li>
                    <i class="fas fa-exclamation mr-2"></i>
                    <span>{{ $error }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif