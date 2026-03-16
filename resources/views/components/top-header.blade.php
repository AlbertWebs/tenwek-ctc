@php
    $contact = config('ctc.contact');
    $phone = $contact['phone'] ?? null;
    $email = $contact['email'] ?? null;
    $address = $contact['address'] ?? null;
    $emergency = $contact['emergency'] ?? null;
@endphp

@if($phone || $email || $address || $emergency)
<header class="bg-ctc-blue-dark text-white" role="banner">
    <div class="border-b border-white/10">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 py-3 sm:py-3.5">
                {{-- Emergency: premium pill + number --}}
                @if($emergency)
                    <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}" class="group flex items-center gap-3 order-first lg:order-none">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 border border-white/20 group-hover:bg-ctc-secondary/20 group-hover:border-ctc-secondary/40 transition-colors duration-200">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/10">
                                <svg class="h-3.5 w-3.5 text-ctc-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-white/90">24/7 Emergency</span>
                        </span>
                        <span class="text-sm font-semibold tracking-tight text-white group-hover:text-ctc-secondary transition-colors">{{ $emergency }}</span>
                    </a>
                @endif

                {{-- Contact row with vertical dividers --}}
                <div class="flex flex-wrap items-center divide-x divide-white/15">
                    @if($phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="inline-flex items-center gap-2.5 px-6 py-1 text-sm text-white/85 hover:text-white transition-colors first:pl-0 last:pr-0">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/70">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <span>{{ $phone }}</span>
                        </a>
                    @endif
                    @if($email)
                        <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2.5 px-6 py-1 text-sm text-white/85 hover:text-white transition-colors first:pl-0 last:pr-0">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/70">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="truncate max-w-[220px] sm:max-w-none">{{ $email }}</span>
                        </a>
                    @endif
                    @if($address)
                        <p class="hidden xl:flex items-center gap-2.5 px-6 py-1 text-sm text-white/75 first:pl-0 last:pr-0">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/60">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <span>{{ $address }}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
@endif
