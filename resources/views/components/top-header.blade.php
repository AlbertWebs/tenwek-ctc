@php
    $contact = config('ctc.contact');
    $phone = $contact['phone'] ?? null;
    $email = $contact['email'] ?? null;
    $address = $contact['address'] ?? null;
    $emergency = $contact['emergency'] ?? null;
@endphp

@if($emergency)
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

                {{-- Mobile should only show the emergency contact. --}}
            </div>
        </div>
    </div>
</header>
@endif
