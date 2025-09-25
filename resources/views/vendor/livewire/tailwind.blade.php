@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between py-8">
            <!-- Mobile Pagination -->
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-default leading-5 rounded-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Anterior
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 leading-5 rounded-lg hover:bg-gray-50 hover:text-cafe-600 focus:outline-none focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 active:bg-gray-100 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Anterior
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-200 leading-5 rounded-lg hover:bg-gray-50 hover:text-cafe-600 focus:outline-none focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 active:bg-gray-100 transition-all duration-200 shadow-sm">
                            Próximo
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-default leading-5 rounded-lg">
                            Próximo
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    @endif
                </span>
            </div>

            <!-- Desktop Pagination -->
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-600 leading-5 bg-gray-50 px-4 py-2 rounded-lg border">
                        <span>Mostrando</span>
                        <span class="font-semibold text-cafe-600">{{ $paginator->firstItem() }}</span>
                        <span>até</span>
                        <span class="font-semibold text-cafe-600">{{ $paginator->lastItem() }}</span>
                        <span>de</span>
                        <span class="font-semibold text-cafe-600">{{ $paginator->total() }}</span>
                        <span>resultados</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-xl shadow-sm bg-white border border-gray-200 overflow-hidden">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="Página anterior">
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-50 cursor-default" aria-hidden="true">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white hover:bg-cafe-50 hover:text-cafe-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-cafe-500 active:bg-cafe-100 transition-all duration-200" aria-label="Página anterior">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white cursor-default border-l border-gray-200">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                              <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white cursor-default border-l shadow-sm" style="background: linear-gradient(135deg, var(--cafe-400) 0%, var(--cafe-blue-400) 50%, var(--cafe-400) 100%); border-color: var(--cafe-400);">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border-l border-gray-200 hover:bg-cafe-50 hover:text-cafe-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-cafe-500 active:bg-cafe-100 transition-all duration-200" aria-label="Ir para página {{ $page }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-l border-gray-200 hover:bg-cafe-50 hover:text-cafe-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-cafe-500 active:bg-cafe-100 transition-all duration-200" aria-label="Próxima página">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="Próxima página">
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-50 cursor-default border-l border-gray-200" aria-hidden="true">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
