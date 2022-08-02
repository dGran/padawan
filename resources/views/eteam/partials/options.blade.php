<li>
    <button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab === $tab_name ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('{{ $tab_name }}')">
        <i class="icon-home text-2xl md:text-3xl lg:4xl"></i>
        <span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam | capitalize">{{ $tab_name }}</span>
    </button>
</li>
