<x-app-layout title="Mis equipos e-sports" breadcrumb=0 wfooter=0 wloader=0>

    @include('account.menu')

    <x-container class="my-6">

        <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{selected:1}">
            <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                <div class="flex items-center justify-between space-x-4">
                    <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fas fa-user-shield w-5"></i>
                    <p class="flex-1 | flex flex-col | leading-5">
                        <span class="text-title-color dark:text-dt-title-color font-medium">Mis equipos</span>
                        <span class="text-xxs | text-text-light-color">Listado equipos e-sports donde eres miembro</span>
                    </p>
                    <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                </div>
            </button>
            <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                <div class="p-6">
                    @include('account/my-teams/myteams')
                </div>
            </div>
        </div>

        <h4 class="pt-3 text-title-color dark:text-dt-title-color">Invitaciones & solicitudes de ingreso</h4>
        <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{{$invitations->count() > 0 ? '{selected:1}' : '{selected:null}'}}">
            <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                <div class="flex items-center justify-between space-x-4">
                    <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-circle-plus w-5"></i>
                    <p class="flex-1 | flex flex-col | leading-5">
                        <span class="text-title-color dark:text-dt-title-color font-medium">Invitaciones recibidas</span>
                        <span class="text-xxs | text-text-light-color">Listado de invitaciones de ingreso a otros equipos</span>
                    </p>
                    @if ($user->countEteamsInvitations() > 0)
                        <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $user->countEteamsInvitations() }}</span>
                    @endif
                    <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                </div>
            </button>
            <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                <div class="p-6">
                    @include('account/my-teams/invitations')
                </div>
            </div>
        </div>

        <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{{$requests->count() > 0 ? '{selected:1}' : '{selected:null}'}}">
            <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                <div class="flex items-center justify-between space-x-4">
                    <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-arrow-up-from-line w-5"></i>
                    <p class="flex-1 | flex flex-col | leading-5">
                        <span class="text-title-color dark:text-dt-title-color font-medium">Solicitudes enviadas</span>
                        <span class="text-xxs | text-text-light-color">Listado de solicitudes de ingreso a otros equipos</span>
                    </p>
                    <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                </div>
            </button>
            <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                <div class="p-6">
                    @include('account/my-teams/requests')
                </div>
            </div>
        </div>

        @if($adminSomeTeam)
            <h4 class="pt-3 text-title-color dark:text-dt-title-color">Mis equipos | <span class="font-bold text-indigo-600 dark:text-indigo-400">Admin</span></h4>
            <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{{$myEteamsInvitations->count() > 0 ? '{selected:1}' : '{selected:null}'}}">
                <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                    <div class="flex items-center justify-between space-x-4">
                        <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-circle-question w-5"></i>
                        <p class="flex-1 | flex flex-col | leading-5">
                            <span class="text-title-color dark:text-dt-title-color font-medium">Invitaciones enviadas</span>
                            <span class="text-xxs | text-text-light-color">Listado de invitaciones enviadas para el ingreso en tus equipos donde eres capitán</span>
                        </p>
                        @if ($user->countMyEteamsInvitations() > 0)
                            <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $user->countMyEteamsInvitations() }}</span>
                        @endif
                        <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                    </div>
                </button>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="p-6">
                        @include('account/my-teams/invitations-send')
                    </div>
                </div>
            </div>

            <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{{$myEteamsRequests->count() > 0 ? '{selected:1}' : '{selected:null}'}}">
                <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                    <div class="flex items-center justify-between space-x-4">
                        <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-arrow-down-to-line w-5"></i>
                        <p class="flex-1 | flex flex-col | leading-5">
                            <span class="text-title-color dark:text-dt-title-color font-medium">Solicitudes recibidas</span>
                            <span class="text-xxs | text-text-light-color">Listado de solicitudes de ingreso en tus equipos donde eres capitán</span>
                        </p>
                        @if ($user->countMyEteamsRequests() > 0)
                            <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $user->countMyEteamsRequests() }}</span>
                        @endif
                        <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
                    </div>
                </button>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="p-6">
                        @include('account/my-teams/requests-received')
                    </div>
                </div>
            </div>
        @endif

    </x-container>

</x-app-layout>
