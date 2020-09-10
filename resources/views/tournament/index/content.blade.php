@if ($tournament->seasons->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament', 'season_selector' => true, 'competition_selector' => false])
@endif

<div class="content p-2">
    <h2>últimas noticias</h2>
    <div class="index-content">
        @if ($season->seasons_posts->count() >0)
            <ul>
                @foreach ($season->seasons_posts->sortByDesc('created_at') as $post)
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
        @else
            <div class="empty-view">
                No se han encontrado noticias
            </div>
        @endif
    </div>
</div>
