<x-card class="sm:p-4 rounded-t-none border-none md:border ">
    <div class="max-w-2xl lg:max-w-4xl mx-4 md:mx-auto my-4 rounded-lg bg-edgray-200 dark:bg-dt-darker border border-border-color dark:border-dt-border-color">
        <div class="bg-edgray-300 dark:bg-dt-dark-accent rounded-t-lg border-b border-border-color dark:border-dt-border-color px-6 py-3 uppercase text-title-color dark:text-dt-title-color">
            Alsance-Village
        </div>
        <div class="p-6">
            <ul class="flex flex-col gap-2">
                <li class="flex items-center">
                    <i class="fas fa-dot-circle mr-2 text-{{ $color }}-600 dark:text-{{ $color }}-400 text-xs"></i>
                    <span class="font-semibold mr-2">Pais:</span>
                    <span>N/D</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-dot-circle mr-2 text-{{ $color }}-600 dark:text-{{ $color }}-400 text-xs"></i>
                    <span class="font-semibold mr-2">Longitud:</span>
                    <span>N/D</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-dot-circle mr-2 text-{{ $color }}-600 dark:text-{{ $color }}-400 text-xs"></i>
                    <span class="font-semibold mr-2">Vueltas:</span>
                    <span>24</span>
                </li>
            </ul>
            <img src="{{ asset('img/circuit.png') }}" alt="" class="mt-8 rounded w-full">
        </div>
    </div>
</x-card>