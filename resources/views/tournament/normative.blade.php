@include('tournament.partials.header', ['activeTab' => 'Normative', 'color' => 'edblue'])

<x-container>

    <h4 class="mt-8 | font-semibold | font-fjalla | uppercase | text-xl md:text-2xl | tracking-widest">Normativa</h4>

    <section class="mt-4 mb-6 md:mt-6 md:mb-8">
        <embed src="{{ asset('tes.pdf') }}" type="application/pdf" height="900" class="w-full rounded-lg" />
    </section>

</x-container>

