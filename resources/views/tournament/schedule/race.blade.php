<div>
    @include('tournament.partials.header', ['activeTab' => 'Schedule', 'color' => 'edblue'])

    <x-container class="sm:my-4 lg:my-8 -mx-4 sm:-mx-4 md:mx-auto">
        <div class="bg-gray-150 dark:bg-dt-dark sm:border border-edgray-800 | rounded-lg">
            @include('tournament.schedule.race.partials.header')

            @include('tournament.schedule.race.partials.menu')

            @switch($op)
                @case('circuit')
                    @include('tournament.schedule.race.circuit')
                    @break
                @case('pilots')
                    @include('tournament.schedule.race.pilots')
                    @break
                @case('qualy')
                    @include('tournament.schedule.race.qualy')
                    @break
                @case('race')
                    @include('tournament.schedule.race.race')
                    @break
                @case('multimedia')
                    @include('tournament.schedule.race.multimedia')
                    @break
            @endswitch

        </div>
    </x-container>
</div>