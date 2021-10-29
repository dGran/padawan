<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
			<div class="flex items-center justify-between space-x-4">
            	<x-button class="rounded-full" disabled="{{ $paginator->onFirstPage() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')"  dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before">
            		<i class="fas fa-angle-left"></i>
            	</x-button>

            	<span class="font-semibold w-12 text-center">
            		{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            	</span>

            	<x-button class="rounded-full" disabled="{{ !$paginator->hasMorePages() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')"  dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after">
            		<i class="fas fa-angle-right"></i>
            	</x-button>
            </div>

        </nav>
        <div class="flex items-center justify-center | pt-2.5">
            <p class="text-xxs md:text-xs text-text-light-color dark:text-dt-text-light-color">
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                <span>{!! __('/') !!}</span>
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                <span>{!! __('de') !!}</span>
                <span class="font-medium">{{ $paginator->total() }}</span>
                <span>{!! __('registros') !!}</span>
            </p>
        </div>
    @else
        <div class="flex items-center justify-center">
            <p class="text-xxs md:text-xs text-text-light-color dark:text-dt-text-light-color">
{{--                 <span class="font-medium">{{ $paginator->firstItem() }}</span>
                <span>{!! __('/') !!}</span>
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                <span>{!! __('de') !!}</span> --}}
                @if ($paginator->total() > 0)
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{{ $paginator->total() == 1 ? 'registro' : 'registros' }}</span>
                @else
                    <span>No existen registros</span>
                @endif
            </p>
        </div>
    @endif
</div>
