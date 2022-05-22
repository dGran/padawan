@if ($eteams->lastPage() > 1)
    <div class="-mb-1.5 | flex items-center justify-end | text-xs md:text-sm | px-3 sm:px-0">
        <p class="text-gray-700 dark:text-gray-300 | flex items-center space-x-1">
            <span class="font-medium">{{ $eteams->firstItem() }}</span>
            <span>/</span>
            <span class="font-medium">{{ $eteams->lastItem() }}</span>
            <span>de</span>
            <span class="font-medium">{{ $eteams->total() }}</span>
            <span>equipos</span>
        </p>
        <div class="pl-3 | flex items-center space-x-0">
            <button wire:click="previousPage({{ $eteams->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-l-md | focus:outline-none">
                <i class="fas fa-chevron-left"></i>
            </button>
            <select class="appearance-none font-bold | h-9 w-10 px-3 text-center | bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | border-t border-b border-gray-200 dark:border-gray-700 | focus:outline-none | cursor-pointer" wire:model="page" wire:change="setCurrentPage">
                @for ($i = 1; $i < $eteams->lastPage()+1 ; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <button wire:click="nextPage({{ $eteams->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-r-md | focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
@endif