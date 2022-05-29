<div class="relative | bg-white dark:bg-dt-dark p-6">
    <div class="flex flex-col | my-1.5">
        <div class="flex flex-col | text-xxs md:text-xs text-text-light-color">
            <p>
                <span class="font-semibold">De:</span> {{ $notification->fromUser ? $notification->fromUser->name : 'padawan e-sports' }}
            </p>
            <p>
                <span class="font-semibold">Recibido:</span> <span>{{ $notification->getCreatedAtDate() }}</span>, <span>{{ $notification->getCreatedAtTime() }}</span>
            </p>

        </div>
        <h3 class="my-4 text-base md:text-lg | font-semibold text-title-color dark:text-dt-title-color">
            {{ $notification->title }}
        </h3>
        <p>
            {!! $notification->content !!}
        </p>
        @if ($notification->link)
            <div class="flex justify-end border-t border-border-color dark:border-dt-border-color | mt-5 pt-5 -mb-2">
                <x-link-button href="{{ $notification->link }}">
                    {{ $notification->link_title ? $notification->link_title : 'Enlace' }}
                </x-link-button>

            </div>
        @endif

    </div>


    <i class="fas fa-times | absolute top-0 right-0 mt-3 mr-4 | text-normal | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>
</div>
