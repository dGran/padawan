<div class="p-4 md:p-6 lg:p-8">
    @foreach ($eteam->posts as $post)
        <div class="mb-3">
            <div class="text-title-color dark:text-dt-title-color">
                {{ $post->title }}
            </div>
            <div class="mt-1 text-xs">
                {{ $post->content }}
            </div>
        </div>
    @endforeach
</div>