<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--header--}}
    <div class="p-4 font-semibold text-title-color dark:text-dt-title-color">
        Noticia #{{ $eteamPost->id }}
    </div>

    {{--content--}}
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Fecha de creación</p>
        <p class="text-sm pl-3 pt-1.5">{{ $eteamPost->getCreatedAtDate() }} - {{ $eteamPost->getCreatedAtTime() }}</p>
    </div>
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Fecha de actualización</p>
        @if ($eteamPost->isUpdated())
            <p class="text-sm pl-3 pt-1.5">{{ $eteamPost->getUpdatedAtDate() }} - {{ $eteamPost->getUpdatedAtTime() }}</p>
        @else
            <p class="text-sm pl-3 pt-1.5">No actualizado</p>
        @endif
    </div>
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Autor</p>
        <p class="text-sm pl-3 pt-1.5">{{ $eteamPost->user->name }}</p>
    </div>
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Título</p>
        <p class="text-sm pl-3 pt-1.5">{{ $eteamPost->title }}</p>
    </div>
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Contenido</p>
        <p class="text-sm pl-3 pt-1.5">{!! nl2br($eteamPost->content) !!}</p>
    </div>
    <div class="p-4 flex flex-col items-start justify-between border-t border-border-color dark:border-edgray-700">
        <p class="text-xs text-text-light-color dark:text-dt-text-light-color">Visibilidad</p>
        <p class="text-xxxs ml-3 mt-1.5 text-center uppercase inline-block w-24 py-1.5 px-2.5 leading-none font-medium rounded {{ $eteamPost->public ? 'bg-edgray-400 text-edgray-900 dark:bg-edgray-600 dark:text-white' : 'bg-yellow-600 dark:bg-yellow-700 text-white' }}">
            {{ $eteamPost->public ? 'pública' : 'privada' }}
        </p>
    </div>

    {{--footer--}}
    <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
        <x-button type="button" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out" wire:click="$emit('closeModal')">
            {{ __('Cerrar') }}
        </x-button>
    </div>
</div>
