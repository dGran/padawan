<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--header--}}
    <div class="p-4 border-b border-border-color dark:border-edgray-700 | font-semibold text-title-color dark:text-dt-title-color">
        Ver noticia
    </div>

    {{--content--}}
    <div class="p-4 flex flex-col space-y-4">
        <p>
            {{ $eteamPost->title }}
        </p>
        <p>
            {{ $eteamPost->content }}
        </p>
    </div>
</div>
