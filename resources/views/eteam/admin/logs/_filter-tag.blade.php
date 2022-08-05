<button class="text-xxs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-edgray-200 text-edgray-700 rounded hover:line-through hover:bg-rose-500 hover:text-rose-100"
    wire:click="clearFilter('{{ $filterName }}')">
    {{ $title }}: {{ $value }}
</button>
