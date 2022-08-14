<div>
    <div class="p-4 md:p-6 lg:p-8">
        @foreach ($posts as $post)
            <div class="pb-3 mb-3 border-b border-border-color dark:border-dt-border-color">
                <div class="">
                    <p class="text-sm md:text-normal | text-title-color dark:text-dt-title-color">{{ $post->title }}</p>
                    <div class="text-xxs md:text-xs | text-light-color dark:text-dt-text-light-color">
                        por <x-link wire:click="$emit('openModal', 'modals.user-modal', {{ json_encode([$post->user]) }})">{{ $post->user->name }}</x-link>-
                        {{ $post->getCreatedAtDate() }}, {{ $post->getCreatedAtTime() }}
                    </div>
                    <p class="p-4 leading-5">{!! nl2br($post->content) !!}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="px-3 py-4 | border-t border-border-color dark:border-dt-border-color | flex items-center justify-center">
        {{ $posts->links('livewire.tailwind-pagination') }}
    </div>
</div>
