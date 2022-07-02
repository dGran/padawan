<x-app-layout title="Notificaciones: {{ $notification->title }}" breadcrumb=1 wfooter=0 wloader=0>
    @section('breadcrumb')
        <li class="min-w-max">
            <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
        </li>
        <li class="min-w-max">
            <x-link class="" href="{{ route('notifications') }}">Notificaciones</x-link><span class="px-1.5">/</span>
        </li>
        <li class="min-w-max">
            <span>{{ $notification->title }}</span>
        </li>
    @endsection

    @include('account.menu')

    <x-container class="my-6">
        <div class="flex flex-col lg:flex-row items-start justify-content-between lg:space-x-12">
            <section class="mt-6 lg:mt-0 order-last lg:order-first w-full lg:w-5/12">
                <h4 class="text-title-color dark:text-dt-title-color font-semibold text-sm">Últimas notificaciones </h4>
                <div class="mt-1.5 bg-white dark:bg-dt-dark rounded-md border border-border-color dark:border-edgray-700">
                    @foreach($lastNotifications as $lastNotification)
                    <a
                        href="{{ route('notifications.view', $lastNotification->slug) }}"
                        aria-current="true"
                        class="flex items-center justify-between space-x-4 px-4 py-2 border-b border-border-color dark:border-edgray-700 w-full text-xs
                        {{ $lastNotification->read ?: 'font-semibold' }}
                        {{ $loop->first ? 'rounded-t-md' : '' }}
                        {{ $loop->last ? 'rounded-b-md' : '' }}
                        {{ $lastNotification->id == $notification->id ? 'pointer-events-none bg-edblue-600 text-white' : 'hover:bg-gray-100 dark:hover:bg-dt-border-color focus:outline-none focus:bg-gray-50 dark:focus:bg-dt-border-color transition duration-150' }}"
                    >
                        <p>
                            <span class="{{ $lastNotification->read ? 'hidden' : '' }}"><i class="fas fa-caret-right"></i></span>
                            <span>{{ $lastNotification->title }}</span>
                        </p>
                        <span class="text-xxxs whitespace-nowrap">{{ $lastNotification->created_at->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }}</span>
                    </a>
                    @endforeach
                </div>
            </section>

            <section class="w-full">
                <h4 class="text-base md:text-xl font-semibold text-title-color dark:text-dt-title-color">
                    {{ $notification->title }}
                </h4>
                <span class="text-xxs md:text-xs | text-text-light-color">Recibida: {{ $notification->getCreatedAtDate() }}, a las {{ $notification->getCreatedAtTime() }}</span>
                <div class="mt-3 p-4 | bg-white dark:bg-dt-dark | border border-border-color dark:border-edgray-700 rounded-md">
                    {!! nl2br($notification->content) !!}
                    @if ($notification->link)
                        <div class="pt-8 flex items-center space-x-2">
                            <i class="fa-solid fa-right-long"></i>
                            <x-link-button href="{{ $notification->link }}" type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                                {{ $notification->link_title }}
                            </x-link-button>
                        </div>
                    @endif
                </div>
                <div class="mt-2 flex items-center justify-end text-xs md:text-sm">
                    <x-link href="{{ route('notifications') }}">
                        {{ __('Volver al listado') }}
                    </x-link>
                </div>
            </section>
        </div>
    </x-container>
</x-app-layout>
