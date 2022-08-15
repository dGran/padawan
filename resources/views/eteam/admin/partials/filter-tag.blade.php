<button class="group flex items-center py-1.5 px-2.5 leading-none bg-gray-200 dark:bg-gray-700 rounded hover:line-through hover:bg-red-500 dark:hover:bg-red-700"
        style="text-decoration-color: white"
        wire:click="clearFilter('{{ $filterName }}')">
    <span class="text-xxxs text-edgray-600 dark:text-edgray-400 group-hover:text-white">{{ $title }}</span>
    @if ($value)
        <span  class="ml-2 text-xxs text-edgray-800 dark:text-edgray-100 group-hover:text-white">{{ $value }}</span>
    @endif
</button>
