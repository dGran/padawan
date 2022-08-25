<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--content--}}
    <div class="p-6 | flex flex-col items-center">
        <p>¿Deseas transferir la propiedad del equipo al usuario <strong>{{ $eteamMember->user->name }}</strong>?</p>
        <p class="font-semibold mt-2.5 text-xs text-rose-500">Perderás todos los privilegios de propietario.</p>
        <p class="font-semibold mt-1.5 text-xs text-rose-500">Esta acción es irreversible.</p>
    </div>

    {{--footer--}}
    <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
        <button type="button" class="inline-block px-4 py-1.5 text-xxs leading-tight rounded hover:text-title-color dark:hover:text-dt-title-color focus:text-title-color dark:focus:text-dt-title-color focus:outline-none transition duration-150 ease-in-out" wire:click="$emit('closeModal')">
            {{ __('No, cancelar') }}
        </button>
        <button type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out" wire:click="transferTeamOwnership()">
            {{ __('Sí, transferir') }}
        </button>
    </div>
</div>
