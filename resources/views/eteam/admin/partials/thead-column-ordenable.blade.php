<th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
    <x-link color="gray" class="group"
            wire:click="setOrder('{{ $order === $order_name ? $order_name_desc : $order_name }}')">
        <span>{{ $column_title }}</span>
        <i class="pl-1 w-3
                {{ $order === $order_name ? 'fa-solid fa-arrow-up-short-wide opacity-100' : '' }}
                {{ $order === $order_name_desc ? 'fa-solid fa-arrow-down-short-wide opacity-100' : '' }}
                {{ $order !== $order_name && $order !== $order_name_desc ? 'fa-solid fa-sort opacity-30 group-hover:opacity-100' : '' }}"
        ></i>
    </x-link>
</th>
