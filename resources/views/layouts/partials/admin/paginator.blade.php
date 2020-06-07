@if ($paginator->hasPages())

    <div class="flex flex-col items-center">
        <div class="flex text-gray-700">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
            @else
                <a class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 hover:bg-pink-600 hover:text-white focus:bg-pink-600 focus:text-white cursor-pointer transition duration-150 ease-in" href="{{ $paginator->previousPageUrl() }}" rel="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex h-8 font-medium rounded-full bg-gray-200">
{{--                 @if($paginator->currentPage() > 3)
                    <a class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full hover:bg-pink-600 hover:text-white" href="{{ $paginator->url(1) }}">1</a>
                @endif
                @if($paginator->currentPage() > 4)
                    <span class="w-8 md:flex justify-center items-center hidden cursor-none leading-5 rounded-full">...</span>
                @endif
                @foreach(range(1, $paginator->lastPage()) as $i)
                    @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                        @if ($i == $paginator->currentPage())
                            <span class="w-8 md:flex justify-center items-center hidden cursor-not-allowed leading-5 rounded-full bg-pink-600 text-white">{{ $i }}</span>
                        @else
                            <a class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full hover:bg-pink-600 hover:text-white" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        @endif
                    @endif
                @endforeach
                @if($paginator->currentPage() < $paginator->lastPage() - 3)
                    <span class="w-8 md:flex justify-center items-center hidden cursor-none leading-5 rounded-full">...</span>
                @endif
                @if($paginator->currentPage() < $paginator->lastPage() - 2)
                    <a class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full hover:bg-pink-600 hover:text-white" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                @endif --}}

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="w-8 md:flex justify-center items-center hidden cursor-none leading-5 rounded-full">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-8 md:flex justify-center items-center hidden cursor-not-allowed leading-5 rounded-full bg-pink-600 text-white">{{ $page }}</span>
                            @else
                                <a class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full hover:bg-pink-600 hover:text-white focus:bg-pink-600 focus:text-white" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer hover:bg-pink-600 hover:text-white focus:bg-pink-600 focus:text-white transition duration-150 ease-in" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            @else
                <span class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            @endif
        </div>
    </div>

@endif