<nav class="ctc-navbar sticky top-0 z-50" role="navigation" aria-label="Main navigation">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">
            {{-- Logo / Brand --}}
            <a href="{{ route('home') }}" class="flex items-center ctc-navbar__brand font-headline tracking-tight transition-colors">
                <span class="leading-[1.05]">
                    <span class="block font-extrabold text-base sm:text-lg text-gray-900">
                        {{ config('ctc.name') }}
                    </span>
                    <span class="block text-xs sm:text-sm font-semibold text-gray-500">
                        {{ config('ctc.hospital') }}
                    </span>
                </span>
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center gap-1">
                @foreach(config('ctc.nav') as $item)
                    @php
                        $children = $item['children'] ?? [];
                        $groups = $item['groups'] ?? [];
                        $dropdownType = $item['dropdown'] ?? 'simple';
                        $hasChildren = (is_array($children) && count($children) > 0) || (is_array($groups) && count($groups) > 0);

                        $href = '#';
                        if (isset($item['url'])) {
                            $href = $item['url'];
                        } elseif (isset($item['route']) && \Illuminate\Support\Facades\Route::has($item['route'])) {
                            $href = route($item['route']);
                        }

                        $isActive = isset($item['route']) && request()->routeIs($item['route']);
                    @endphp

                    @if($hasChildren)
                        <li class="relative group">
                            <a href="{{ $href }}"
                               class="ctc-nav-link px-3 py-2 inline-flex items-center gap-1 border-b-2 pb-1 transition-all {{ $isActive ? 'is-active' : 'border-transparent' }}">
                                {{ $item['label'] }}
                                <svg class="w-4 h-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>

                            @if($dropdownType === 'mega' && is_array($groups) && count($groups) > 0)
                                @php
                                    $groupCount = count($groups);
                                    $cols = min(3, max(2, $groupCount));
                                    $maxW = $cols <= 2 ? 600 : 880;
                                @endphp
                                <div class="ctc-dropdown absolute left-1/2 -translate-x-1/2 top-full pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <div class="ctc-mega-panel" style="--ctc-mega-max-w: {{ $maxW }}px;">
                                        <div class="ctc-mega-grid" style="--ctc-mega-cols: {{ $cols }};">
                                            @foreach($groups as $group)
                                                <div class="ctc-mega-col">
                                                    <h4 class="ctc-mega-title">{{ $group['title'] ?? 'Section' }}</h4>
                                                    <ul class="ctc-mega-list">
                                                        @foreach(($group['links'] ?? []) as $child)
                                                            @php
                                                                $childHref = null;
                                                                if (isset($child['url'])) {
                                                                    $childHref = $child['url'];
                                                                } elseif (isset($child['route']) && \Illuminate\Support\Facades\Route::has($child['route'])) {
                                                                    $childHref = route($child['route']);
                                                                }
                                                            @endphp
                                                            @if($childHref)
                                                                <li>
                                                                    <a href="{{ $childHref }}" class="ctc-mega-link">
                                                                        {{ $child['label'] ?? 'Link' }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="ctc-dropdown absolute left-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <div class="min-w-64 rounded-xl border border-gray-200 bg-white shadow-lg overflow-hidden">
                                        <ul class="py-2">
                                            @foreach($children as $child)
                                                @php
                                                    $childHref = null;
                                                    if (isset($child['url'])) {
                                                        $childHref = $child['url'];
                                                    } elseif (isset($child['route']) && \Illuminate\Support\Facades\Route::has($child['route'])) {
                                                        $childHref = route($child['route']);
                                                    }
                                                @endphp
                                                @if($childHref)
                                                    <li>
                                                        <a href="{{ $childHref }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-ctc-blue transition-colors">
                                                            {{ $child['label'] ?? 'Link' }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @else
                        <li>
                            <a href="{{ $href }}"
                               class="ctc-nav-link px-3 py-2 border-b-2 pb-1 transition-all {{ $isActive ? 'is-active' : 'border-transparent' }}">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            {{-- Mobile menu button --}}
            <button type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="ctc-navbar__menu-btn lg:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-ctc-blue"
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
             class="ctc-navbar__mobile lg:hidden"
             role="dialog"
             aria-modal="true"
             aria-label="Mobile menu">
            <ul class="py-4 space-y-1 px-4">
                @foreach(config('ctc.nav') as $item)
                    @php
                        $children = $item['children'] ?? [];
                        $groups = $item['groups'] ?? [];
                        $dropdownType = $item['dropdown'] ?? 'simple';
                        $hasChildren = (is_array($children) && count($children) > 0) || (is_array($groups) && count($groups) > 0);

                        $href = '#';
                        if (isset($item['url'])) {
                            $href = $item['url'];
                        } elseif (isset($item['route']) && \Illuminate\Support\Facades\Route::has($item['route'])) {
                            $href = route($item['route']);
                        }

                        $isActive = isset($item['route']) && request()->routeIs($item['route']);

                        $isChildActive = false;
                        if (!$isActive) {
                            if ($dropdownType === 'mega' && is_array($groups) && count($groups) > 0) {
                                foreach ($groups as $g) {
                                    foreach (($g['links'] ?? []) as $child) {
                                        if (isset($child['route']) && request()->routeIs($child['route'])) {
                                            $isChildActive = true;
                                            break 2;
                                        }
                                    }
                                }
                            } else {
                                foreach ($children as $child) {
                                    if (isset($child['route']) && request()->routeIs($child['route'])) {
                                        $isChildActive = true;
                                        break;
                                    }
                                }
                            }
                        }

                        $defaultOpen = $hasChildren && ($isActive || $isChildActive);
                        $panelId = 'mobile-nav-panel-' . $loop->index;
                    @endphp

                    <li class="rounded-xl"
                        x-data="{ open: {{ $defaultOpen ? 'true' : 'false' }} }">
                        <div class="flex items-center gap-2">
                            <a href="{{ $href }}"
                               @click="mobileMenuOpen = false"
                               class="ctc-navbar__mobile-link block flex-1 px-3 py-2 rounded-md text-base font-medium {{ $isActive ? 'is-active' : '' }}">
                                {{ $item['label'] }}
                            </a>

                            @if($hasChildren)
                                <button type="button"
                                        class="shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-lg text-gray-500 hover:text-ctc-blue hover:bg-gray-50 transition-colors"
                                        @click="open = !open"
                                        :aria-expanded="open ? 'true' : 'false'"
                                        aria-controls="{{ $panelId }}"
                                        aria-label="Toggle {{ $item['label'] }} menu">
                                    <svg class="h-5 w-5 transition-transform duration-200"
                                         :class="open ? 'rotate-180' : ''"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        @if($hasChildren)
                            <div id="{{ $panelId }}"
                                 x-show="open"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-1"
                                 class="mt-1 mb-2 ml-3 border-l border-gray-200 pl-3">
                                @if($dropdownType === 'mega' && is_array($groups) && count($groups) > 0)
                                    @foreach($groups as $group)
                                        <p class="mt-3 first:mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-400">
                                            {{ $group['title'] ?? 'Section' }}
                                        </p>
                                        <ul class="mt-1 space-y-1">
                                            @foreach(($group['links'] ?? []) as $child)
                                                @php
                                                    $childHref = null;
                                                    if (isset($child['url'])) {
                                                        $childHref = $child['url'];
                                                    } elseif (isset($child['route']) && \Illuminate\Support\Facades\Route::has($child['route'])) {
                                                        $childHref = route($child['route']);
                                                    }
                                                @endphp
                                                @if($childHref)
                                                    <li>
                                                        <a href="{{ $childHref }}"
                                                           @click="mobileMenuOpen = false"
                                                           class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-ctc-blue hover:bg-gray-50 transition-colors">
                                                            {{ $child['label'] ?? 'Link' }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endforeach
                                @else
                                    <ul class="space-y-1">
                                        @foreach($children as $child)
                                            @php
                                                $childHref = null;
                                                if (isset($child['url'])) {
                                                    $childHref = $child['url'];
                                                } elseif (isset($child['route']) && \Illuminate\Support\Facades\Route::has($child['route'])) {
                                                    $childHref = route($child['route']);
                                                }
                                            @endphp
                                            @if($childHref)
                                                <li>
                                                    <a href="{{ $childHref }}"
                                                       @click="mobileMenuOpen = false"
                                                       class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-ctc-blue hover:bg-gray-50 transition-colors">
                                                        {{ $child['label'] ?? 'Link' }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
