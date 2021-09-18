<x-card class="sm:p-4 rounded-t-none border-none md:border ">
    <div class="m-4 rounded-lg bg-edgray-200 dark:bg-dt-darker border border-border-color dark:border-dt-border-color">
        <div class="bg-edgray-300 dark:bg-dt-dark-accent rounded-t-lg border-b border-border-color dark:border-dt-border-color px-6 py-3 uppercase text-title-color dark:text-dt-title-color">
            Alsance-Village
        </div>
        <div class="p-6">
            <div wire:poll.1s class="pb-4">
                {{-- Current time: {{ $date->format('H:i:s') }} --}}
                @foreach ($positions as $key => $position)
                    <li><span class="mr-3">Pos. {{ $key }}</span>{{ $position['name'] }}</li>
                @endforeach
            </div>
            Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Accusamus sit, dignissimos labore quaerat a soluta, libero unde quibusdam voluptatum rem maiores iusto magni expedita necessitatibus? Molestiae cupiditate minus dignissimos perspiciatis.
        </div>

    </div>
</x-card>