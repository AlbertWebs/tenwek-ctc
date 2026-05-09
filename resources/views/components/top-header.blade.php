@php
    $contact = config('ctc.contact');
    $phone = $contact['phone'] ?? null;
    $email = $contact['email'] ?? null;
    $address = $contact['address'] ?? null;
    $emergency = $contact['emergency'] ?? null;
@endphp

@if($phone || $email || $address || $emergency)
<header id="ctc-topbar" class="ctc-topbar text-white">
    <div class="border-b border-white/10">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:gap-4 py-1 sm:py-1.5 lg:py-2">
                {{-- Emergency: compact on small screens, centered on mobile --}}
                @if($emergency)
                    <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}"
                       class="group flex w-full items-center justify-center gap-2.5 sm:gap-3 lg:w-auto lg:justify-start order-first lg:order-none">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/[0.08] px-2.5 py-0.5 sm:px-3 sm:py-1 border border-white/15 group-hover:bg-ctc-secondary/15 group-hover:border-ctc-secondary/35 transition-all duration-200">
                            <span class="flex h-4.5 w-4.5 items-center justify-center rounded-full bg-white/10">
                                <svg class="h-2.5 w-2.5 text-ctc-secondary/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <span class="text-[8px] sm:text-[9px] font-medium uppercase tracking-[0.16em] sm:tracking-[0.18em] text-white/88">24/7 Emergency</span>
                        </span>
                        <span class="text-[12px] sm:text-[13px] font-medium tracking-wide text-white/95 tabular-nums group-hover:text-ctc-secondary transition-colors">{{ $emergency }}</span>
                    </a>
                @endif

                {{-- Contact row (hide on mobile) --}}
                <div class="hidden sm:flex flex-wrap items-center divide-x divide-white/15">
                    @if($phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="inline-flex items-center gap-2 px-4 lg:px-6 py-1 text-[11px] text-white/82 hover:text-white transition-colors first:pl-0 last:pr-0">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/65">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <span>{{ $phone }}</span>
                        </a>
                    @endif
                    @if($email)
                        <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2 px-4 lg:px-6 py-1 text-[11px] text-white/82 hover:text-white transition-colors first:pl-0 last:pr-0">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/65">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="truncate max-w-[220px] sm:max-w-none">{{ $email }}</span>
                        </a>
                    @endif
                    @if($address)
                        <p class="hidden xl:flex items-center gap-2 px-4 lg:px-6 py-1 text-[11px] text-white/72 first:pl-0 last:pr-0">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-lg bg-white/5 text-white/55">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
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
