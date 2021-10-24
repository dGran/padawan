<div>
    <div class="absolute bottom-0 right-0 | -mr-0.5 -mb-0.5" wire:poll.1s>
        @if ($notifications > 0)
            <span class="bg-red-500 text-white | font-semibold text-xxxs | rounded-full | w-5 h-5 pt-0.5 | flex items-center justify-center">
                {{ $notifications > 9 ? '9+' : $notifications }}
            </span>
        @endif
    </div>
</div>
