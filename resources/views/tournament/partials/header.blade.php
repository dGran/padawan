<div class="relative">
	<div class="banner-landing bg-{{ $color }}-700 dark:bg-{{ $color }}-900 relative overflow-hidden">
		<x-container class="pt-6 lg:py-8 text-white">
            <div class="grid grid-cols-1 lg:grid-flow-col lg:auto-cols-max gap-x-16 gap-y-6 lg:gap-y-12">
                <div class="flex flex-col justify-center lg:justify-between text-center px-6 lg:text-left lg:px-0 order-last lg:order-first">
                    <div class="lg:mt-8">
                        <p class="text-2xl lg:text-3xl | font-raleway font-extrabold">
                            Supra GT Cup
                        </p>
                        <p class="text-lg lg:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                            Gran Turismo Sport / PS5
                        </p>
{{--                         <p class="text-2xl lg:text-3xl | font-raleway font-extrabold | pt-2">
                            16 torneos activos
                        </p> --}}

                    </div>
                    <div class="mt-4 | flex justify-center lg:justify-start">
                        @include('tournament.partials.menu')
                    </div>
                </div>


                <div class="-mx-4 -mt-6 sm:-mx-0 sm:mt-0">
                    {{-- <figure class="flex justify-center | w-full max-h-60 h-auto "> --}}
    				   <img src="{{ asset('img/tbanner.jpeg') }}" alt="" class="w-full h-auto sm:max-w-sm lg:max-w-xs | sm:rounded-lg | mx-auto">
                    {{-- </figure> --}}
                </div>
            </div>
        </x-container>
{{--         <div class="hidden md:flex items-center justify-center | bg-{{ $color }}-700 dark:bg-{{ $color }}-800 -mt-4">
            <x-container>
                @include('tournament.partials.menu')
            </x-container>
        </div> --}}
    </div>
</div>
