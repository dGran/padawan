<div>
    @include('tournament.partials.header', ['activeTab' => 'Schedule', 'color' => 'edblue'])

    <x-container>

        <h4 class="mt-8 | font-semibold | font-fjalla | uppercase | text-xl md:text-2xl | tracking-wider | text-title-color dark:text-dt-title-color">Calendario</h4>
        <section class="mt-4 mb-6 md:mt-6 md:mb-8">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi eaque, distinctio tempore tenetur labore delectus recusandae numquam quod quia incidunt exercitationem perferendis consequuntur. Delectus perspiciatis at a sequi, praesentium amet.

            <x-link href="{{ route('tournament.race', 'color=edblue') }}">Carrera 1</x-link>
            <x-link href="{{ route('tournament.race', 'op=qualy', 'color=edblue') }}">Carrera 1 - Qualy</x-link>
        </section>

    </x-container>
</div>