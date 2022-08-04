<div>
    @section('breadcrumb')
        @include('eteam.partials.breadcrumb')
    @endsection

    <x-container>
        <div class="flex items-center | mt-4 lg:mt-8">
            @if ($eteam->country)
                <img src="{{ $eteam->country->getFlag32() }}" alt="{{ $eteam->getCountryName() }}"
                     title="{{ $eteam->getCountryName() }}" class="mr-3">
            @endif
            <h4 class="text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | uppercase">
                {{ $eteam->name }}
            </h4>
        </div>
        <x-card class="mt-4 mb-4 lg:mb-8 | text-xs lg:text-sm">
            <div class="rounded-t-md relative select-none">
                <img src="{{ $eteam->getBanner() }}" alt=""
                     class="w-full h-32 sm:h-40 md:h-48 lg:h-64 xl:h-80 object-cover rounded-t-md opacity-90">
                <div class="absolute h-full flex items-center"
                     style="top: 50%; left: 50%; transform: translate(-50%, -35%);">
                    <img src="{{ $eteam->getLogo() }}" alt=""
                         class="w-28 h-28 sm:w-36 sm:h-36 md:w-44 md:h-44 lg:w-60 lg:h-60 xl:w-72 xl:h-72 | rounded-full | bg-white | object-contain | p-0.5 | shadow-2xl">
                </div>
            </div>
            @include('eteam.partials.menu')

            @auth
                @include('eteam.partials.actions')
            @endauth

            @switch($tab)
                @case('sede')
                    @livewire('eteam.options.eteam-home', ['eteam' => $eteam])
                    @break
                @case('noticias')
                    @livewire('eteam.options.eteam-post', ['eteam' => $eteam])
                    @break
                @case('miembros')
                    @livewire('eteam.options.eteam-member', ['eteam' => $eteam])
                    @break
                @case('multimedia')
                    @livewire('eteam.options.eteam-file', ['eteam' => $eteam])
                    @break
                @case('palmares')
                    @livewire('eteam.options.eteam-fame', ['eteam' => $eteam])
                    @break
                @case('admin')
                    @include('eteam.admin.index')
                    @break
            @endswitch
        </x-card>
    </x-container>
</div>
