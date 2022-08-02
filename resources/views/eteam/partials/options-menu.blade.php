<li>
    <button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab === $option_name ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('{{ $option_name }}')">
        <i class="{{ $option_icon }} text-2xl md:text-3xl lg:4xl"></i>
        <span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam | capitalize">{{ $option_name }}</span>
    </button>
</li>
