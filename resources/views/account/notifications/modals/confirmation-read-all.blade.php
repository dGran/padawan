<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" @click="open = false"></i>

    {{--content--}}
    <div class="p-6 | flex flex-col items-center">
        <p>¿Deseas marcar como leídas todas las notificaciones?</p>
    </div>

    {{--footer--}}
    <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
        <form method="GET" action="{{ route('notifications.readAll', $user) }}">
            @csrf
            <button type="button" class="inline-block px-4 py-1.5 text-xxs leading-tight rounded hover:text-title-color dark:hover:text-dt-title-color focus:text-title-color dark:focus:text-dt-title-color focus:outline-none transition duration-150 ease-in-out" @click="open = false">
                {{ __('No, cancelar') }}
            </button>
            <button type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                {{ __('Sí, marcar todo como leído') }}
            </button>
        </form>
    </div>
</div>
