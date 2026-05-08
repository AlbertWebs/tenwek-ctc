@php
    $contact = config('ctc.contact', []);
    $footer = config('ctc.footer', []);
    $social = array_filter(config('ctc.social', []));

    $primaryPhone = $contact['phone'] ?? null;
    $emergency = $contact['emergency'] ?? null;
    $email = $contact['email'] ?? null;
    $address = $contact['address'] ?? null;

    $hospitalName = config('ctc.hospital');
    $centreName = config('ctc.name');
    $tagline = config('ctc.tagline');

    $description = $footer['description'] ?? ($hospitalName . '. ' . $tagline . '.');
    $columns = $footer['columns'] ?? [];
    $legalLinks = $footer['legal_links'] ?? [];

    $routeUrl = function (?string $route, ?string $fallbackUrl = null) {
        if ($route && \Illuminate\Support\Facades\Route::has($route)) {
            return route($route);
        }
        return $fallbackUrl;
    };
@endphp

<footer class="bg-ctc-blue-dark text-white mt-auto overflow-hidden relative border-t-4 border-ctc-secondary" role="contentinfo">
    <div class="absolute inset-0 opacity-[0.06] pointer-events-none" aria-hidden="true">
        <svg width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 100 100">
            <path d="M0 100 Q 50 0 100 100" fill="none" stroke="white" stroke-width=".2" />
            <path d="M0 75 Q 50 -25 100 75" fill="none" stroke="white" stroke-width=".12" />
        </svg>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10 relative">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-10 gap-y-14 mb-14">
            <div class="col-span-2 md:col-span-4 lg:col-span-2">
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="block text-[11px] font-semibold uppercase tracking-[0.22em] text-white/50">Powered by</span>
                        <span class="block text-lg font-semibold text-white/90">{{ $hospitalName }}</span>
                    </div>

                    <div class="pt-2">
                        <span class="block text-2xl font-bold tracking-tight text-white">{{ $centreName }}</span>
                        <p class="mt-3 text-white/65 text-sm leading-relaxed max-w-sm font-medium">{{ $description }}</p>
                    </div>

                    @if(count($social) > 0)
                        <div class="flex items-center gap-4 pt-2">
                            @foreach($social as $name => $href)
                                <a href="{{ $href }}" target="_blank" rel="noopener noreferrer" class="text-white/55 hover:text-white transition-colors text-sm font-semibold">
                                    <span class="sr-only">{{ $name }}</span>
                                    <span class="underline decoration-white/20 hover:decoration-white/60 underline-offset-4">{{ $name }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @foreach($columns as $col)
                <div class="space-y-6">
                    <h4 class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-white/55">{{ $col['title'] ?? 'Links' }}</h4>
                    <ul class="space-y-3 text-xs font-semibold text-white/60">
                        @foreach(($col['links'] ?? []) as $item)
                            @php
                                $href = $routeUrl($item['route'] ?? null, $item['url'] ?? null);
                            @endphp
                            @if($href)
                                <li>
                                    <a href="{{ $href }}" class="hover:text-white transition-colors">{{ $item['label'] ?? 'Link' }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-10 py-10 border-t border-white/10">
            <div class="col-span-2 md:col-span-2 space-y-6">
                <h4 class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-white/55">Contact</h4>
                <address class="not-italic space-y-3 text-sm text-white/70">
                    @if($address)
                        <p class="leading-relaxed">{{ $address }}</p>
                    @endif
                    @if($primaryPhone)
                        <p>
                            <span class="block text-[10px] text-white/45 uppercase tracking-widest font-bold mb-1">Phone</span>
                            <a href="tel:{{ preg_replace('/\D+/', '', $primaryPhone) }}" class="text-white/85 hover:text-white transition-colors font-semibold">{{ $primaryPhone }}</a>
                        </p>
                    @endif
                    @if($email)
                        <p>
                            <span class="block text-[10px] text-white/45 uppercase tracking-widest font-bold mb-1">Email</span>
                            <a href="mailto:{{ $email }}" class="text-white/85 hover:text-white transition-colors font-semibold break-all">{{ $email }}</a>
                        </p>
                    @endif
                </address>
            </div>

            <div class="col-span-2 md:col-span-2 lg:col-span-2 space-y-6 lg:pl-6">
                <h4 class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-white/55">Emergency access</h4>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="rounded-xl bg-white/5 border border-white/10 p-5">
                        <span class="block text-[10px] text-white/45 uppercase tracking-widest font-bold mb-2">24/7 emergency</span>
                        @if($emergency)
                            <a href="tel:{{ preg_replace('/\D+/', '', $emergency) }}" class="block text-white font-bold text-sm hover:text-ctc-secondary transition-colors">{{ $emergency }}</a>
                        @else
                            <span class="block text-white/70 text-sm">Call the main hospital line</span>
                        @endif
                    </div>
                    <div class="rounded-xl bg-white/5 border border-white/10 p-5">
                        <span class="block text-[10px] text-white/45 uppercase tracking-widest font-bold mb-2">Appointments</span>
                        @php $contactHref = $routeUrl('contact'); @endphp
                        @if($contactHref)
                            <a href="{{ $contactHref }}" class="inline-flex items-center justify-center w-full rounded-lg bg-ctc-secondary px-4 py-3 text-[11px] font-bold uppercase tracking-[0.18em] text-white hover:bg-ctc-secondary-dark transition-colors">
                                Contact Us
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-2 flex items-end justify-start lg:justify-end">
                <div class="w-full text-left lg:text-right">
                    <p class="text-[10px] text-white/40 font-bold uppercase tracking-[0.28em]">
                        &copy; {{ date('Y') }} {{ $hospitalName }}. All rights reserved.
                    </p>
                    <p class="mt-2 text-[10px] text-white/30 font-semibold uppercase tracking-[0.22em]">
                        Cardiothoracic Centre website
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-7 flex flex-wrap gap-6 text-[10px] font-bold uppercase tracking-[0.35em] text-white/35">
            @foreach($legalLinks as $item)
                @php
                    $href = $item['url'] ?? null;
                    $label = $item['label'] ?? null;
                @endphp
                @if($href && $label)
                    <a href="{{ $href }}" class="hover:text-white transition-colors">{{ $label }}</a>
                @elseif($label && $href === null)
                    <span class="text-white/25">{{ $label }}</span>
                @endif
            @endforeach
        </div>
    </div>
</footer>
