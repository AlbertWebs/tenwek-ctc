@php
    $contact = config('ctc.contact', []);
    $phone = $contact['phone'] ?? null;
    $email = $contact['email'] ?? null;
    $address = $contact['address'] ?? null;
    $emergency = $contact['emergency'] ?? null;

    $social = array_filter([
        'Facebook' => \App\Models\SiteSetting::getValue('social.facebook', config('ctc.social.Facebook')),
        'LinkedIn' => \App\Models\SiteSetting::getValue('social.linkedin', config('ctc.social.LinkedIn')),
        'Instagram' => \App\Models\SiteSetting::getValue('social.instagram', config('ctc.social.Instagram')),
        'TikTok' => \App\Models\SiteSetting::getValue('social.tiktok', config('ctc.social.TikTok')),
        'YouTube' => \App\Models\SiteSetting::getValue('social.youtube', config('ctc.social.YouTube')),
        'X' => \App\Models\SiteSetting::getValue('social.x', config('ctc.social.X')),
    ]);

    $emergencyNorm = $emergency ? preg_replace('/\D+/', '', (string) $emergency) : '';
    $phoneNorm = $phone ? preg_replace('/\D+/', '', (string) $phone) : '';
    $emergencyDiffers = $emergencyNorm !== '' && $emergencyNorm !== $phoneNorm;

    $showBar = $phone || $email || $address || $emergency || count($social) > 0;
@endphp

@if($showBar)
<header id="ctc-topbar" class="ctc-topbar text-white @if(! $emergency) max-lg:hidden @endif">
    <div class="relative z-[1] border-b border-ctc-secondary/25">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Mobile / tablet: emergency only --}}
            @if($emergency)
                <div class="lg:hidden py-2">
                    <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}"
                       class="group flex w-full items-center justify-center gap-2.5">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/[0.07] px-2.5 py-0.5 sm:px-3 sm:py-1 border border-ctc-secondary/25 ring-1 ring-inset ring-ctc-magenta/10 group-hover:bg-ctc-secondary/12 group-hover:border-ctc-secondary/40 transition-all duration-200">
                            <span class="flex h-4.5 w-4.5 items-center justify-center rounded-full bg-ctc-secondary/15">
                                <svg class="h-2.5 w-2.5 text-ctc-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <span class="text-[8px] sm:text-[9px] font-medium uppercase tracking-[0.16em] sm:tracking-[0.18em] text-white/88">24/7 Emergency</span>
                        </span>
                        <span class="text-[12px] sm:text-[13px] font-medium tracking-wide text-white tabular-nums group-hover:text-ctc-secondary transition-colors">{{ $emergency }}</span>
                    </a>
                </div>
            @endif

            {{-- Desktop: full contact row + social --}}
            <div class="hidden lg:flex lg:flex-wrap lg:items-center lg:justify-between lg:gap-x-8 lg:gap-y-2 lg:py-2">
                <div class="flex flex-wrap items-center gap-x-8 gap-y-2 text-[12px] text-white/90 min-w-0 flex-1">
                    @if($address)
                        <span class="inline-flex items-start gap-2 max-w-xl min-w-0">
                            <svg class="h-4 w-4 shrink-0 mt-0.5 text-ctc-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="leading-snug">{{ $address }}</span>
                        </span>
                    @endif

                    @if($phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="inline-flex items-center gap-2 shrink-0 font-medium tabular-nums text-white/92 hover:text-ctc-secondary transition-colors">
                            <svg class="h-4 w-4 shrink-0 text-ctc-secondary/85" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $phone }}
                            @if($emergency && ! $emergencyDiffers)
                                <span class="ml-1 rounded bg-ctc-secondary/18 px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-ctc-secondary">24/7</span>
                            @endif
                        </a>
                    @endif

                    @if($email)
                        <a href="mailto:{{ $email }}" class="group inline-flex items-center gap-2 shrink-0 text-white/90 hover:text-ctc-magenta-light/95 transition-colors min-w-0 max-w-md">
                            <svg class="h-4 w-4 shrink-0 text-ctc-magenta/50 group-hover:text-ctc-magenta-light/90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="truncate">{{ $email }}</span>
                        </a>
                    @endif

                    @if($emergency && $emergencyDiffers)
                        <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}"
                           class="inline-flex items-center gap-2 shrink-0 rounded-full bg-white/[0.07] px-3 py-1 border border-ctc-secondary/30 ring-1 ring-inset ring-ctc-magenta/10 hover:bg-ctc-secondary/12 hover:border-ctc-secondary/45 transition-all">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-ctc-secondary/18">
                                <svg class="h-3 w-3 text-ctc-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <span class="text-[9px] font-bold uppercase tracking-[0.18em] text-white/88">Emergency</span>
                            <span class="text-[12px] font-medium tabular-nums text-white/95">{{ $emergency }}</span>
                        </a>
                    @elseif($emergency && ! $phone)
                        <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}"
                           class="inline-flex items-center gap-2 shrink-0 rounded-full bg-white/[0.07] px-3 py-1 border border-ctc-secondary/30 ring-1 ring-inset ring-ctc-magenta/10 hover:bg-ctc-secondary/12 transition-all">
                            <span class="text-[9px] font-bold uppercase tracking-[0.18em] text-white/88">24/7</span>
                            <span class="text-[12px] font-medium tabular-nums">{{ $emergency }}</span>
                        </a>
                    @endif
                </div>

                @if(count($social) > 0)
                    <div class="flex items-center gap-2 shrink-0 lg:border-l lg:border-ctc-secondary/25 lg:pl-6 xl:pl-8">
                        <span class="hidden xl:block text-[9px] font-bold uppercase tracking-[0.2em] text-ctc-secondary/60 pr-1">Follow</span>
                        <div class="flex items-center gap-1.5">
                            @foreach($social as $name => $href)
                                <a href="{{ $href }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-white/12 bg-white/[0.06] text-white/78 hover:text-ctc-secondary hover:border-ctc-secondary/35 hover:bg-ctc-secondary/10 transition-colors"
                                   aria-label="{{ $name }} (opens in new tab)">
                                    @switch($name)
                                        @case('Facebook')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 10-11.56 9.87v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.88h-2.32v6.99A10 10 0 0022 12z"/></svg>
                                            @break
                                        @case('Instagram')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3.5A4.5 4.5 0 1016.5 12 4.5 4.5 0 0012 7.5zm0 7.4A2.9 2.9 0 1114.9 12 2.9 2.9 0 0112 14.9zM17.6 6.4a1 1 0 11-1-1 1 1 0 011 1z"/></svg>
                                            @break
                                        @case('YouTube')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2a2.7 2.7 0 00-1.9-1.9C18 4.9 12 4.9 12 4.9s-6 0-7.7.4A2.7 2.7 0 002.4 7.2 28.1 28.1 0 002 12a28.1 28.1 0 00.4 4.8 2.7 2.7 0 001.9 1.9c1.7.4 7.7.4 7.7.4s6 0 7.7-.4a2.7 2.7 0 001.9-1.9A28.1 28.1 0 0022 12a28.1 28.1 0 00-.4-4.8zM10 15.5V8.5L16 12l-6 3.5z"/></svg>
                                            @break
                                        @case('X')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-6.8 7.8L23 22h-6.6l-5.2-6.6L5.4 22H2l7.3-8.4L1 2h6.8l4.7 6.1L18.9 2zm-1.2 18h1.7L7.1 3.9H5.3L17.7 20z"/></svg>
                                            @break
                                        @case('LinkedIn')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5A2.5 2.5 0 102.5 6a2.5 2.5 0 002.48-2.5zM3 8.98h3.96V21H3V8.98zM9.5 8.98H13.3v1.64h.05c.53-1 1.83-2.06 3.77-2.06 4.03 0 4.78 2.65 4.78 6.1V21h-3.96v-5.4c0-1.29-.02-2.95-1.8-2.95-1.8 0-2.08 1.4-2.08 2.86V21H9.5V8.98z"/></svg>
                                            @break
                                        @case('TikTok')
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.7 2h-3.2v12.3c0 1.6-1.3 2.9-2.9 2.9s-2.9-1.3-2.9-2.9 1.3-2.9 2.9-2.9c.3 0 .6 0 .9.1V8.2c-.3 0-.6-.1-.9-.1-3.4 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2V8.7c1.3 1 3 1.6 4.9 1.6V7.1c-2.3 0-4.2-1.9-4.2-4.2V2z"/></svg>
                                            @break
                                        @default
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14h-2v-2h2v2zm0-4h-2V6h2v6z"/></svg>
                                    @endswitch
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
@endif
