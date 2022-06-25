<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--header--}}
    <div class="p-4 border-b border-border-color dark:border-edgray-700 | font-semibold text-title-color dark:text-dt-title-color">
        Mensaje
    </div>

    {{--content--}}
    <div class="p-6 | flex flex-col items-center">
        <p>{!! nl2br($message) !!}</p>
    </div>

    {{--footer--}}
    <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
        <button type="button" wire:click="$emit('closeModal')" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
            Aceptar
        </button>
    </div>
</div>
