@extends('layouts.app')

@section('title', 'Research')

@php($metaDescription = 'Research at Tenwek CTC: clinical studies, research areas, publications, and collaboration to improve outcomes in resource-limited settings.')

@section('content')
    @include('components.page-banner', [
        'title' => 'Research',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'research',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Research', 'url' => route('research')],
        ],
    ])

    {{-- Intro + on-page navigation --}}
    <section class="relative border-b border-gray-200/80 bg-gradient-to-b from-ctc-grey-light/90 to-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
            <div class="max-w-3xl">
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">Evidence &amp; learning</p>
                <p class="mt-3 text-lg sm:text-xl text-gray-700 leading-relaxed">
                    We study outcomes, strengthen training, and share what we learn—so cardiothoracic care keeps improving for patients across East Africa and similar settings.
                </p>
            </div>

            <nav class="mt-8 flex flex-wrap gap-2" aria-label="On this page">
                <a href="#research-areas"
                   class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs font-semibold text-ctc-blue shadow-sm transition hover:border-ctc-secondary/40 hover:bg-ctc-grey-light/80">
                    <span class="h-1.5 w-1.5 rounded-full bg-ctc-accent" aria-hidden="true"></span>
                    Research areas
                </a>
                <a href="#clinical-studies"
                   class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs font-semibold text-ctc-blue shadow-sm transition hover:border-ctc-secondary/40 hover:bg-ctc-grey-light/80">
                    <span class="h-1.5 w-1.5 rounded-full bg-ctc-secondary" aria-hidden="true"></span>
                    Clinical studies
                </a>
                <a href="#publications"
                   class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs font-semibold text-ctc-blue shadow-sm transition hover:border-ctc-secondary/40 hover:bg-ctc-grey-light/80">
                    <span class="h-1.5 w-1.5 rounded-full bg-ctc-blue" aria-hidden="true"></span>
                    Publications
                </a>
                <a href="#annual-reports"
                   class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs font-semibold text-ctc-blue shadow-sm transition hover:border-ctc-secondary/40 hover:bg-ctc-grey-light/80">
                    <span class="h-1.5 w-1.5 rounded-full bg-ctc-magenta/80" aria-hidden="true"></span>
                    Annual reports
                </a>
            </nav>
        </div>
    </section>

    <section class="py-14 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-8 space-y-10 lg:space-y-12">
                    <?php
                        $cards = [
                            [
                                'id' => 'research-areas',
                                'title' => 'Research areas',
                                'accent' => 'bg-ctc-accent',
                                'icon' => 'areas',
                                'body' => '<p>Our research focuses on outcomes in cardiac and thoracic surgery in resource-limited settings, congenital heart disease, valve disease, and training effectiveness. We collaborate with universities and research institutions locally and internationally.</p>',
                            ],
                            [
                                'id' => 'clinical-studies',
                                'title' => 'Clinical studies',
                                'accent' => 'bg-ctc-secondary',
                                'icon' => 'studies',
                                'body' => '<p>We participate in and lead clinical studies that improve patient care and inform best practices. Studies are conducted with appropriate ethics approval and patient consent.</p>',
                            ],
                            [
                                'id' => 'publications',
                                'title' => 'Publications',
                                'accent' => 'bg-ctc-blue',
                                'icon' => 'pubs',
                                'body' => '<p>Our team publishes in peer-reviewed journals and presents at regional and international conferences. Publications are listed in annual reports and can be requested through our contact channels.</p>',
                                'cta' => ['label' => 'View publications hub', 'route' => route('research.publications')],
                            ],
                            [
                                'id' => 'annual-reports',
                                'title' => 'Annual reports',
                                'accent' => 'bg-ctc-magenta',
                                'icon' => 'reports',
                                'body' => '<p>We produce annual reports summarizing our clinical activity, training, research, and outreach. These reports are available to partners and supporters.</p>',
                                'cta' => ['label' => 'Request a report', 'route' => route('contact')],
                            ],
                        ];
                    ?>

                    @foreach($cards as $card)
                        <article id="{{ $card['id'] }}" class="scroll-mt-24 lg:scroll-mt-28 relative rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-sm transition-shadow hover:shadow-md">
                            <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl {{ $card['accent'] }}" aria-hidden="true"></div>
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-ctc-grey-light text-ctc-blue ring-1 ring-gray-200/80" aria-hidden="true">
                                    @if($card['icon'] === 'areas')
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 15.3m14.8 0l.402-.402M5 15.3l-.402.402M19.8 15.3a2.25 2.25 0 01-2.016 0"/></svg>
                                    @elseif($card['icon'] === 'studies')
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                                    @elseif($card['icon'] === 'pubs')
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    @else
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h2 class="font-headline text-xl sm:text-2xl font-extrabold tracking-tight text-ctc-blue">
                                        {{ $card['title'] }}
                                    </h2>
                                    <div class="mt-3 prose prose-slate max-w-none text-gray-600 prose-p:leading-relaxed prose-p:text-[0.95rem]">
                                        {!! $card['body'] !!}
                                    </div>
                                    @if(!empty($card['cta']))
                                        <div class="mt-5">
                                            <a href="{{ $card['cta']['route'] }}"
                                               class="inline-flex items-center gap-2 text-sm font-semibold text-ctc-blue hover:text-ctc-secondary transition-colors">
                                                {{ $card['cta']['label'] }}
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-24 space-y-4">
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                            <div class="border-b border-gray-100 bg-ctc-grey-light/50 px-5 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-gray-500">Quick links</p>
                                <p class="mt-1 text-sm text-gray-600">Continue exploring research and training.</p>
                            </div>
                            <ul class="divide-y divide-gray-100">
                                <li>
                                    <a href="{{ route('research.publications') }}" class="flex items-center justify-between gap-3 px-5 py-4 transition hover:bg-ctc-grey-light/60">
                                        <span class="text-sm font-semibold text-ctc-blue">Publications</span>
                                        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('training-research') }}" class="flex items-center justify-between gap-3 px-5 py-4 transition hover:bg-ctc-grey-light/60">
                                        <span class="text-sm font-semibold text-ctc-blue">Training &amp; Research hub</span>
                                        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contact') }}" class="flex items-center justify-between gap-3 px-5 py-4 transition hover:bg-ctc-grey-light/60">
                                        <span class="text-sm font-semibold text-ctc-blue">Contact the team</span>
                                        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="rounded-2xl border border-ctc-secondary/25 bg-gradient-to-br from-ctc-secondary/10 to-white p-5 shadow-sm">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-ctc-secondary">Collaborate</p>
                            <p class="mt-2 text-sm text-gray-700 leading-relaxed">
                                Interested in joint studies, data partnerships, or visiting scholars? Tell us about your idea—we’ll connect you with the right people.
                            </p>
                            <a href="{{ route('contact') }}"
                               class="mt-4 inline-flex w-full items-center justify-center rounded-xl bg-ctc-blue px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-ctc-blue-dark">
                                Start a conversation
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @include('components.cta-section', [
        'title' => 'Stay connected with our work',
        'description' => 'Request publications, ask about collaboration, or learn how research informs care at Tenwek CTC.',
        'buttonLabel' => 'Contact us',
        'buttonUrl' => route('contact'),
    ])
@endsection
