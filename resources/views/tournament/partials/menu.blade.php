<div class="flex items-center space-x-2 | overflow-x-scroll | text-sm lg:text-normal | text-{{ $color }}-100 dark:text-{{ $color }}-200 | -mx-6 md:-mx-0 py-2 my-1 | scrollbar-thin thinest scrollbar-thumb-{{ $color }}-600 scrollbar-track-{{ $color }}-700 hover:scrollbar-thumb-{{ $color }}-500 dark:scrollbar-thumb-{{ $color }}-800 dark:scrollbar-track-{{ $color }}-900 dark:hover:scrollbar-thumb-{{ $color }}-700 scrollbar-thumb-rounded-full">


    @if ($activeTab === 'Dashboard')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Dashboard</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.dashboard') }}">Dashboard</a>
    @endif

    @if ($activeTab === 'Stats')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Pre-Qualy</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.schedule') }}">Pre-Qualy</a>
    @endif

    @if ($activeTab === 'Standings')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Clasificaciones</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.standings') }}">Clasificaciones</a>
    @endif

    @if ($activeTab === 'Schedule')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Calendario</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.schedule') }}">Calendario</a>
    @endif

{{--     @if ($activeTab === 'Stats')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Estadísticas</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.stats') }}">Estadísticas</a>
    @endif --}}

    @if ($activeTab === 'Participants')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Participantes</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.participants') }}">Participantes</a>
    @endif

   @if ($activeTab === 'Normative')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | cursor-not-allowed">Normativa</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-600 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | font-condensed | hover:bg-{{ $color }}-500 dark:hover:bg-{{ $color }}-700 | focus:bg-{{ $color }}-500 dark:focus:bg-{{ $color }}-700 focus:outline-none" href="{{ route('tournament.normative') }}">Normativa</a>
    @endif
</div>