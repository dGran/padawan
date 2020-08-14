<div class="content p-2">

    {{-- <div class="w-full md:w-3/4"> --}}
    <h2>últimas noticias</h2>
    <div class="index-content">
        <ul>
            @foreach ($tournament->seasons->first()->seasons_posts as $post)
                <li>
                    <div class="item-container">
                        <img src="{{ $post->img() }}">
                        <div class="text">
                            <p class="post-title text-{{ $tournament->game->platform->color }}-700">{{ $post->title }}</p>
                            <p class="post-content">{!! nl2br(e($post->content)) !!}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    {{-- </div> --}}
</div>
