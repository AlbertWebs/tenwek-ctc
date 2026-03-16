<nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm" role="navigation" aria-label="Main navigation">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">
            {{-- Logo / Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-ctc-blue font-semibold text-lg hover:text-ctc-blue-dark transition-colors">
                <span>{{ config('ctc.name') }}</span>
                <span class="text-gray-500 font-normal hidden sm:inline">— {{ config('ctc.hospital') }}</span>
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center gap-1">
                @foreach(config('ctc.nav') as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs($item['route']) ? 'text-ctc-blue bg-ctc-grey-light' : 'text-gray-600 hover:text-ctc-blue hover:bg-gray-50' }} transition-colors">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Mobile menu button --}}
            <button type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 rounded-md text-gray-600 hover:text-ctc-blue hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-ctc-blue"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    :aria-expanded="mobileMenuOpen">
                <span class="sr-only">Open menu</span>
                <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu"
             x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-gray-200 bg-white"
             role="dialog"
             aria-modal="true"
             aria-label="Mobile menu">
            <ul class="py-4 space-y-1 px-4">
                @foreach(config('ctc.nav') as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           @click="mobileMenuOpen = false"
                           class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs($item['route']) ? 'text-ctc-blue bg-ctc-grey-light' : 'text-gray-600 hover:text-ctc-blue hover:bg-gray-50' }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
