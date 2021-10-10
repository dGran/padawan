@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'bg-white dark:bg-dt-dark'])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }

    $width = 'w-' . $width;
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open, $nextTick(() => $refs.search.focus())" @keyup.enter="open = ! open, $nextTick(() => $refs.search.focus())">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} {{ $alignmentClasses }}"
            style="display: none;">
        <div class="rounded-md border border-gray-300 dark:border-gray-500 overflow-hidden {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
