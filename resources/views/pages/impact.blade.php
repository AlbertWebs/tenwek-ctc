@extends('layouts.app')

@section('title', 'Our Impact')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Impact',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12 items-start">
                <div class="lg:col-span-5">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Impact</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                        A beacon of hope and healing
                    </h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Every surgery has a story. Our patients come from across Kenya and the region—children with congenital heart defects,
                        adults with valve disease or coronary disease, and those needing thoracic surgery. These stories of hope and healing drive our mission.
                    </p>

                    <div class="mt-8 rounded-2xl border border-gray-200 bg-ctc-grey-light p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">Milestones</p>
                        <ul class="mt-4 space-y-3 text-gray-700 text-sm">
                            <li class="flex items-start gap-3"><span class="mt-0.5 h-2 w-2 rounded-full bg-ctc-accent"></span><span><span class="font-semibold text-ctc-blue">5,000+</span> open heart surgeries performed</span></li>
                            <li class="flex items-start gap-3"><span class="mt-0.5 h-2 w-2 rounded-full bg-ctc-accent"></span><span><span class="font-semibold text-ctc-blue">50+</span> surgeons trained through fellowship and visiting programs</span></li>
                            <li class="flex items-start gap-3"><span class="mt-0.5 h-2 w-2 rounded-full bg-ctc-accent"></span><span><span class="font-semibold text-ctc-blue">15+</span> countries represented by our patients</span></li>
                            <li class="flex items-start gap-3"><span class="mt-0.5 h-2 w-2 rounded-full bg-ctc-accent"></span><span><span class="font-semibold text-ctc-blue">25+</span> years of cardiothoracic service at Tenwek</span></li>
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                        @if(!empty($feature?->media_url))
                            <div class="aspect-video bg-black">
                                <iframe
                                    src="{{ $feature->media_url }}"
                                    class="h-full w-full"
                                    title="Impact media"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        @else
                            <div class="aspect-video bg-ctc-grey-light">
                                <img
                                    src="{{ $feature?->image_url ?: config('ctc.page_banner_image') }}"
                                    alt="Impact at Tenwek CTC"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue/75">
                                <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.18)]"></span>
                                From the centre
                            </div>
                            <p class="mt-3 text-sm text-gray-600">This media block is editable from the admin panel when you add a story image or media URL.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6 flex-wrap">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Patient stories</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">Stories of hope</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed max-w-2xl">Featured stories and moments from the CTC—patients, partners, and training impact.</p>
                </div>
            </div>

            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
                @forelse($stories as $s)
                    <div class="h-full rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
                        <div class="aspect-video bg-ctc-grey-light">
                            <img src="{{ $s->image_url ?: config('ctc.page_banner_image') }}" alt="{{ $s->title }}" class="h-full w-full object-cover" loading="lazy">
                        </div>
                        <div class="p-6">
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">
                                {{ $s->story_date?->format('M Y') ?? 'Story' }}
                            </p>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">{{ $s->title }}</h3>
                            @if($s->story)
                                <p class="mt-3 text-sm text-gray-600 leading-relaxed line-clamp-3">{{ $s->story }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No stories yet.</p>
                @endforelse
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-12 items-start">
                <div class="lg:col-span-7 rounded-2xl bg-white border border-gray-200 shadow-sm p-6 sm:p-8">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Global impact</p>
                    <h3 class="mt-3 text-xl font-semibold text-ctc-blue">Training, partnerships, and sustainable care</h3>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        The CTC’s impact extends beyond our campus. Our graduates serve in hospitals across East Africa and beyond.
                        By training local surgeons and maintaining high standards of care, we contribute to a sustainable model of cardiothoracic care for Africa.
                    </p>
                </div>
                <div class="lg:col-span-5 rounded-2xl bg-white border border-gray-200 shadow-sm p-6 sm:p-8">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">From the news</p>
                    <h3 class="mt-3 text-xl font-semibold text-ctc-blue">Latest updates</h3>
                    <div class="mt-5 space-y-4">
                        @forelse($latestNews as $n)
                            <a href="{{ route('news.show', $n->slug) }}" class="block group">
                                <p class="text-sm font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors line-clamp-2">
                                    <span class="inline-block mr-2 align-middle h-1.5 w-1.5 rounded-full bg-ctc-accent/90"></span>{{ $n->title }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">{{ optional($n->published_at ?? $n->created_at)->format('M j, Y') }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-gray-600">No news yet.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('news') }}" class="mt-6 inline-flex items-center text-sm font-semibold text-ctc-secondary hover:underline">View all news →</a>
                </div>
            </div>
        </div>
    </section>
@endsection
