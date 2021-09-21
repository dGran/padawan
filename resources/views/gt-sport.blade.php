<x-app-layout title="">
	<div class="relative">
		<div class="banner-landing bg-red-600 dark:bg-red-900 relative overflow-hidden">
			<x-container class="py-8 text-white">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                    	<img src="{{ asset('img/banner_sport.jpeg') }}" alt="">
{{--                         <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0 order-last md:order-first">
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
                                Gran Turismo Sport
                            </p>
                            <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit
                            </p>
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
                                16 torneos activos
                            </p>
                            <p class="text-red-200 | text-normal md:text-base | pt-6">
                                Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Excepturi laboriosam cupiditate fugit explicabo incidunt! Error nemo, cupiditate, sapiente molestiae necessitatibus aperiam numquam debitis amet veniam blanditiis, veritatis exercitationem, consequuntur et?
                            </p>
                        </div> --}}

                        <div class="flex justify-center">
							<img src="https://www.gran-turismo.com/common/images/gtsport/manual/logo_gts.svg" alt="" class="h-40 md:h-52">
                        </div>
                    </div>

{{-- 				<div class="flex flex-col items-center justify-center">
		    		<img src="https://www.gran-turismo.com/common/images/gtsport/manual/logo_gts.svg" alt="" class="h-40 md:h-52">
		    		Campeonato
				</div> --}}
            </x-container>
        </div>
    </div>
	<x-container>
		<div class="my-6">
			<h4 class="text-title-color dark:text-dt-title-color font-semibold text-base md:text-lg">Campeonatos activos</h4>
			<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-4">

				<div class="bg-white dark:bg-dt-dark p-2 rounded-lg shadow-lg">
					<img src="{{ asset('img/banner_sport.jpeg') }}" alt="" class="w-full md:h-48 md:w-auto rounded-t-lg object-cover">
					<h4 class="font-bold text-title-color dark:text-dt-title-color py-1.5 text-center bg-border-color dark:bg-dt-border-color">FIA GT CHAMPIONSHIPS</h4>
					<div class="flex items-center justify-between rounded-b-lg border border-border-color dark:border-dt-border-color px-4 py-2">
						<div class="flex items-center">
							<i class="icon-pilot"></i><span class="ml-2 text-xxs">32</span>
						</div>
						<i class="icon-brand-playstation"></i>
					</div>
				</div>

				<div class="bg-white dark:bg-dt-dark p-2 rounded-lg shadow-lg">
					<img src="https://www.gran-turismo.com/images/c/i15BBhNHRTAxkuB.jpg" alt="" class="w-full md:h-48 md:w-auto rounded-t-lg">
					<h4 class="font-bold text-title-color dark:text-dt-title-color py-1.5 text-center bg-border-color dark:bg-dt-border-color">MANUFACTURER SERIES</h4>
					<div class="flex items-center justify-between rounded-b-lg border border-border-color dark:border-dt-border-color px-4 py-2">
						<div class="flex items-center">
							<i class="icon-pilot"></i><span class="ml-2 text-xxs">32</span>
						</div>
						<i class="icon-brand-playstation"></i>
					</div>
				</div>

				<div class="bg-white dark:bg-dt-dark p-2 rounded-lg shadow-lg">
					<img src="https://www.gran-turismo.com/images/c/i1YlIsb8W7aqQuH.jpg" alt="" class="w-full md:h-48 md:w-auto rounded-t-lg">
					<h4 class="font-bold text-title-color dark:text-dt-title-color py-1.5 text-center bg-border-color dark:bg-dt-border-color">16 SUPERSTARS</h4>
					<div class="flex items-center justify-between rounded-b-lg border border-border-color dark:border-dt-border-color px-4 py-2">
						<div class="flex items-center">
							<i class="icon-pilot"></i><span class="ml-2 text-xxs">32</span>
						</div>
						<i class="icon-brand-playstation"></i>
					</div>
				</div>

				<div class="bg-white dark:bg-dt-dark p-2 rounded-lg shadow-lg">
					<img src="https://www.gran-turismo.com/images/c/i1aEhlYeWPTH0uH.jpg" alt="" class="w-full md:h-48 md:w-auto rounded-t-lg">
					<h4 class="font-bold text-title-color dark:text-dt-title-color py-1.5 text-center bg-border-color dark:bg-dt-border-color">NATIONS CUP</h4>
					<div class="flex items-center justify-between rounded-b-lg border border-border-color dark:border-dt-border-color px-4 py-2">
						<div class="flex items-center">
							<i class="icon-pilot"></i><span class="ml-2 text-xxs">32</span>
						</div>
						<i class="icon-brand-playstation"></i>
					</div>
				</div>

			</div>
		</div>

    </x-container>
</x-app-layout>