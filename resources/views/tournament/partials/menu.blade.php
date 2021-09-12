<div
	class="flex items-center gap-2 | overflow-x-auto | text-{{ $color }}-200 text-normal md:text-base | -mx-6 md:-mx-0 py-4 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">


    @if ($activeTab === 'Dashboard')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Dashboard</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.dashboard') }}">Dashboard</a>
    @endif
    @if ($activeTab === 'Standings')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Clasificaciones</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.standings') }}">Clasificaciones</a>
    @endif

    @if ($activeTab === 'Schedule')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Calendario</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.schedule') }}">Calendario</a>
    @endif
    @if ($activeTab === 'Stats')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Estadísticas</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.stats') }}">Estadísticas</a>
    @endif
    @if ($activeTab === 'Participants')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Participantes</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.participants') }}">Participantes</a>
    @endif
   @if ($activeTab === 'Normative')
        <span class="min-w-max | bg-{{ $color }}-100 dark:bg-{{ $color }}-100 | text-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed">Normativa</span>
    @else
        <a class="min-w-max | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 | px-3 py-1.5 | rounded-md | text-sm | font-condensed | hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700" href="{{ route('tournament.normative') }}">Normativa</a>
    @endif
</div>