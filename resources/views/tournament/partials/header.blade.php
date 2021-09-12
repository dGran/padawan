<div class="relative">
	<div class="banner-landing bg-{{ $color }}-600 dark:bg-{{ $color }}-900 relative overflow-hidden">
		<x-container class="pt-8 md:py-8 text-white">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-6 lg:gap-y-12">
                <div class="flex flex-col justify-center text-center px-6 lg:text-left lg:px-0 order-last lg:order-first">
                    <p class="text-2xl lg:text-3xl | font-raleway font-extrabold">
                        Supra GT Cup
                    </p>
                    <p class="text-lg lg:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                        Gran Turismo Sport / PS5
                    </p>
{{--                             <p class="text-2xl lg:text-3xl | font-raleway font-extrabold | pt-2">
                        16 torneos activos
                    </p> --}}
                    <div class="md:hidden mt-4 | flex justify-center">
                        @include('tournament.partials.menu')
                    </div>
                </div>

                <div class="flex justify-center">
					<img src="https://www.gran-turismo.com/images/c/i1CRjXbSSGn0WSB.jpg" alt="" class="h-40 lg:h-52 rounded-lg">
                </div>
            </div>
        </x-container>
        <div class="hidden md:flex items-center justify-center |  bg-{{ $color }}-700 dark:bg-{{ $color }}-800 -mt-4">
            <x-container>
                @include('tournament.partials.menu')
            </x-container>
        </div>
    </div>
</div>