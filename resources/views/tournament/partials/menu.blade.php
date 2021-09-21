<div class="flex items-center justify-between md:justify-center space-x-4 sm:space-x-6 md:space-x-12 | overflow-x-auto overflow-y-hidden | scrollbar-thin thinest scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-1 md:mb-2 | focus:outline-none">
            <i class="icon-circuit text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Circuito</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-1 md:mb-2 | focus:outline-none">
            <i class="icon-circuit text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Circuito</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-1 md:mb-2 | focus:outline-none">
            <i class="icon-circuit text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Circuito</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-1 md:mb-2 | focus:outline-none">
            <i class="icon-circuit text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Circuito</span>
        </button>
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

