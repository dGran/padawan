<div class="bg-gradient-to-r from-gray-150 via-white to-gray-150 dark:from-dt-darkest dark:via-dt-dark dark:to-dt-darkest | select-none">
    <ul class="flex items-center justify-between sm:justify-center space-x-1.5 sm:space-x-3 | p-4 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'log' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('log')">
                Log
            </button>
        </li>
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'noticias' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('noticias')">
                Noticias
            </button>
        </li>
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'miembros' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('miembros')">
                Miembros
            </button>
        </li>
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'gestion' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('gestion')">
                Gestión
            </button>
        </li>
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'multimedia' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('multimedia')">
                Multimedia
            </button>
        </li>
        <li>
            <button class="flex items-center justify-center w-24 px-4 py-2 | rounded-md | focus:outline-none | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:border-border-color dark:focus:border-dt-border-color {{ $adminTab == 'perfil' ? 'bg-border-color dark:bg-dt-border-color pointer-events-none' : '' }}" wire:click="changeAdminTab('perfil')">
                Perfil
            </button>
        </li>
    </ul>
</div>
