@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium  bg-primary opacity-30 drop-shadow bordercursor-default leading-5 ">
                {!! __('Prev') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-primary drop-shadow  border-gray-300 leading-5 hover:bg-gray-50 focus:outline-none focus:ring ring-gray-50 focus:border-blue-300 active:bg-gray-100 transition ease-in-out duration-150">
                {!! __('Prev') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-primary drop-shadow  leading-5 hover:bg-gray-50 focus:outline-none focus:ring ring-gray-50 focus:border-blue-300 active:bg-gray-100 transition ease-in-out duration-150">
                {!! __('Next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-200 opacity-50 bg-primary drop-shadow cursor-default leading-5">
                {!! __('Next') !!}
            </span>
        @endif
    </nav>
@endif
