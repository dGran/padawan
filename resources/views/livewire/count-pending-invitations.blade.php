<div>
    <div class="absolute top-0 right-0 | -mr-0.5 -mt-0.5" wire:poll.1s>
        @if ($invitations > 0)
            <span class="bg-edyellow-500 text-white | font-semibold text-xxxs | rounded-full | w-5 h-5 pt-0.5 | flex items-center justify-center">
                {{ $invitations > 9 ? '9+' : $invitations }}
            </span>
        @endif
    </div>
</div>