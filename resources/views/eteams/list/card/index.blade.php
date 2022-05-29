@if ($eteams->count() > 0)      
    <div class="my-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6">
        @foreach ($eteams as $eteam)
            @include('eteams.list.card.item')
        @endforeach
    </div>
@else
    <div class="my-4 | rounded border border-border-color dark:border-gray-700">
        @include('eteams.list.empty')
    </div>
@endif
