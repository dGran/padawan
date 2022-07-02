@include('account.menu')

<x-container class="my-6">

    <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{selected:1}">
        <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fas fa-circle-info w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Información general</span>
                    <span class="text-xxs | text-text-light-color">Datos generales de la cuenta</span>
                </p>
                <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
            @include('account/profile/general-data')
        </div>
    </div>

    <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{selected:1}">
        <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-share-nodes w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Redes sociales</span>
                    <span class="text-xxs | text-text-light-color">Información de cuentas en redes sociales</span>
                </p>
                <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
            @include('account/profile/social-data')
        </div>
    </div>

    <div class="relative my-2.5 bg-white dark:bg-dt-dark border border-border-color dark:border-transparent rounded-md shadow-md" x-data="{selected:1}">
        <button type="button" class="group | w-full px-4 py-2.5 text-left focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fas fa-gamepad w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Perfiles de jugador</span>
                    <span class="text-xxs | text-text-light-color">Información de cuentas en plataformas de juego</span>
                </p>
                <i class="flex-initial text-xxs | px-1.5 py-1 group-hover:text-title-color dark:group-hover:text-dt-title-color group-focus:text-title-color dark:group-focus:text-dt-title-color | fa-solid" :class="selected == 1 ? 'fa-angle-up' : 'fa-angle-down'"></i>
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
            @include('account/profile/gamer-data')
        </div>
    </div>

</x-container>
