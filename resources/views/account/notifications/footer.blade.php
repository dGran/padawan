@if ($notifications->lastPage() > 1)
    <div class="flex items-center justify-end | text-xxs md:text-xs | px-0">
        <p class="text-text-light-color | flex items-center space-x-1">
            <span class="font-medium">{{ $notifications->firstItem() }}</span>
            <span>/</span>
            <span class="font-medium">{{ $notifications->lastItem() }}</span>
            <span>de</span>
            <span class="font-medium">{{ $notifications->total() }}</span>
            <span>notificaciones</span>
        </p>
        <div class="pl-3 | flex items-center space-x-0">
            <button wire:click="previousPage({{ $notifications->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-l-md | focus:outline-none">
                <i class="fas fa-chevron-left"></i>
            </button>
            <select class="appearance-none font-bold | h-9 w-10 px-3 text-center | bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | border-t border-b border-gray-200 dark:border-gray-700 | focus:outline-none | cursor-pointer" wire:model="page" wire:change="setCurrentPage">
                @for ($i = 1; $i < $notifications->lastPage()+1 ; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <button wire:click="nextPage({{ $notifications->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-r-md | focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
@endif
