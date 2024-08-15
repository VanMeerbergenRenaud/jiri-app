<div class="pagination">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation">
            <h3 role="heading" aria-level="3" class="sr-only">Pagination navigation</h3>

            {{-- Small device : 2 parts --}}
            <div class="small-device">

                {{-- 1. Previous --}}
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="previous">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button"
                                class="previous"
                                wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled"
                        >
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                {{-- 2. Next --}}
                <span>
                    @if ($paginator->hasMorePages())
                        <button
                            type="button"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            class="next"
                        >
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="next">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            {{-- Large device : 2 parts --}}
            <div class="large-device">

                {{-- 1. Showing results (left) --}}
                <div class="left">
                    <p>
                        Affichage de
                        <span>{{ $paginator->firstItem() }}</span>
                        à
                        <span>{{ $paginator->lastItem() }}</span>
                        sur
                        <span>{{ $paginator->total() }}</span>
                        résultats
                    </p>
                </div>

                {{-- 2. Pagination numbers (right) --}}
                <div class="right">

                    {{-- Previous page link --}}
                    <span>
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span class="previous-arrow" aria-hidden="true">
                                    <x-svg.nav-arrow-left />
                                </span>
                            </span>
                        @else
                            <button type="button"
                                    class="previous-arrow"
                                    rel="prev"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    aria-label="{{ __('pagination.previous') }}">
                                <x-svg.nav-arrow-left />
                            </button>
                        @endif
                    </span>

                    {{-- Pagination elements --}}
                    @foreach ($elements as $element)

                        {{-- "Three Dots" separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="dots">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array of links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page">
                                            <span class="current-page">{{ $page }}</span>
                                        </span>
                                    @else
                                        <button type="button"
                                                class="current-page"
                                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                                aria-label="{{ __('Aller à la page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next page link --}}
                    <span>
                        @if ($paginator->hasMorePages())
                            <button type="button"
                                    class="next-arrow"
                                    rel="next"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    aria-label="{{ __('pagination.next') }}"
                            >
                                <x-svg.nav-arrow-right />
                            </button>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="next-arrow" aria-hidden="true">
                                    <x-svg.nav-arrow-right />
                                </span>
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
