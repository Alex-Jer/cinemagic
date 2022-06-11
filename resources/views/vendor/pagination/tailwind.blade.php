@if ($paginator->hasPages())
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase sm:grid-cols-9 dark:text-gray-400 {{ !Route::current()->getName() === 'films.index' ? 'bg-white border-t dark:border-gray-700 dark:bg-gray-800' : '-mt-20' }}">
        <span class="flex items-center col-span-3">
            a mostrar
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
            @endif
            de {{ $paginator->total() }}
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple dark:text-gray-600 text-gray-300"
                            aria-label="Previous">
                            <svg class="w-4 h-4" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple dark:text-gray-200"
                            aria-label="Previous">
                            <svg class="w-4 h-4" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span class="px-3 py-1">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li>
                                    @if ($page == $paginator->currentPage())
                                        <a
                                            class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            {{ $page }}
                                        </a>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            {{ $page }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple dark:text-gray-200"
                            aria-label="Next">
                            <svg class="w-4 h-4" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple dark:text-gray-600 text-gray-300"
                            aria-label="Next">
                            <svg class="w-4 h-4" data-darkreader-inline-stroke="" fill="none" stroke="currentColor"
                                style="--darkreader-inline-stroke: currentColor;" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </ul>
            </nav>
        </span>

    </div>
@endif
