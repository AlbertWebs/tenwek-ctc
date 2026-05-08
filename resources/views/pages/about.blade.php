@extends('layouts.app')

@section('title', 'About CTC')

@section('content')
    @include('components.page-banner', [
        'title' => 'About the Centre',
        'subtitle' => config('ctc.hospital'),
    ])

    {{-- Admin-driven sections (with optional image/media) --}}
    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($sections) && $sections->count())
                <div class="space-y-12 lg:space-y-16">
                    @foreach($sections as $i => $section)
                        @php
                            $odd = ($i % 2) === 1;
                            $hasMedia = !empty($section->featured_image_url) || !empty($section->media_url);
                        @endphp

                        <div class="grid gap-8 lg:grid-cols-12 items-center">
                            <div class="{{ $hasMedia ? 'lg:col-span-6' : 'lg:col-span-12' }} {{ $odd ? 'lg:order-2' : '' }}">
                                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">About</p>
                                <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                                    {{ $section->title }}
                                </h2>
                                @if($section->content)
                                    <div class="mt-4 prose prose-slate max-w-none prose-headings:font-headline prose-headings:text-ctc-blue prose-p:text-gray-700 prose-p:leading-relaxed">
                                        {!! nl2br(e($section->content)) !!}
                                    </div>
                                @endif
                            </div>

                            @if($hasMedia)
                                <div class="lg:col-span-6 {{ $odd ? 'lg:order-1' : '' }}">
                                    <div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                                        @if($section->featured_image_url)
                                            <div class="aspect-video bg-ctc-grey-light">
                                                <img src="{{ $section->featured_image_url }}" alt="{{ $section->title }}" class="h-full w-full object-cover">
                                            </div>
                                        @endif

                                        @if($section->media_url)
                                            <div class="aspect-video bg-black">
                                                <iframe
                                                    src="{{ $section->media_url }}"
                                                    class="h-full w-full"
                                                    title="{{ $section->title }}"
                                                    loading="lazy"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen
                                                ></iframe>
                                            </div>
                                        @endif

                                        <div class="p-5 bg-white">
                                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue/75">
                                                <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.18)]"></span>
                                                Centre story
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback copy if no admin sections are created yet --}}
                <div class="max-w-3xl">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">About</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">A centre of excellence</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        The Cardiothoracic Centre (CTC) at Tenwek Hospital provides comprehensive care for adult and pediatric patients with cardiac and thoracic conditions,
                        from diagnosis through surgery and follow‑up.
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- Mission & Vision (subtle gold accents) --}}
    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Purpose</p>
                <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">Mission & Vision</h2>
            </div>
            <div class="mt-8 grid md:grid-cols-2 gap-8 max-w-5xl">
                <div class="rounded-2xl bg-white border border-ctc-accent/25 shadow-sm p-6">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Mission</p>
                    <h3 class="mt-2 text-xl font-semibold text-ctc-blue">Excellent, compassionate care</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed">To provide excellent, compassionate cardiothoracic care to all who need it, and to train the next generation of surgeons and healthcare workers for Africa.</p>
                </div>
                <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">Vision</p>
                    <h3 class="mt-2 text-xl font-semibold text-ctc-blue">Access for every patient</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed">A region where every person has access to life‑saving heart and chest surgery, delivered by well‑trained local teams.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
