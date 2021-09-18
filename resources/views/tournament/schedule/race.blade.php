<div>
    @include('tournament.partials.header', ['activeTab' => 'Schedule', 'color' => $color])

    <div class="max-w-screen-2xl mx-auto md:p-4 lg:p-8">
        <div class="bg-white dark:bg-dt-dark md:border border-border-color dark:border-dt-border-color | md:rounded-lg">
            @include('tournament.schedule.race.partials.header')

            @include('tournament.schedule.race.partials.menu')

            @switch($op)
                @case('circuito')
                    @include('tournament.schedule.race.circuit')
                    @break
                @case('pilotos')
                    @include('tournament.schedule.race.pilots')
                    @break
                @case('calificacion')
                    @include('tournament.schedule.race.qualy')
                    @break
                @case('carrera')
                    @include('tournament.schedule.race.race')
                    @break
                @case('multimedia')
                    @include('tournament.schedule.race.multimedia')
                    @break
            @endswitch

        </div>

    </div>
{{--     <x-container class="md:my-4 lg:my-8 -mx-4 sm:-mx-4 md:mx-auto">
    </x-container> --}}
</div>