@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between items-center mt-4">
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 mx-1 text-white bg-red-800 rounded hover:bg-red-900">
                    Anterior
                </a>
            @endif

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 mx-1 text-white bg-red-800 rounded hover:bg-red-900">
                    Siguiente
                </a>
            @else
                <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                    Siguiente
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Botón Anterior --}}
                    @if ($paginator->onFirstPage())
                        <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                            ⬅️
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 mx-1 text-white bg-red-800 rounded hover:bg-red-900">
                            ⬅️
                        </a>
                    @endif

                    {{-- Números de Página --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="px-4 py-2 mx-1 text-white bg-red-600 rounded">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 mx-1 text-red-800 bg-white border border-red-800 rounded hover:bg-red-800 hover:text-white">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Botón Siguiente --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 mx-1 text-white bg-red-800 rounded hover:bg-red-900">
                            ➡️
                        </a>
                    @else
                        <span class="px-4 py-2 mx-1 text-gray-400 bg-gray-200 rounded cursor-not-allowed">
                            ➡️
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
