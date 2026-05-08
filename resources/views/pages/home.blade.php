@extends('layouts.app')

@section('title', 'Home')

@section('hero')
    @include('components.hero-section', [
        'title' => 'Cardiothoracic Centre',
        'subtitle' => 'Tenwek Hospital',
        'description' => 'Excellence in heart and chest surgery, training, and research in East Africa. We provide life-saving care and build the next generation of cardiothoracic surgeons.',
        'mode' => $heroMode ?? 'video',
        'video' => $heroVideoUrl ?? null,
        'slides' => $heroSlides ?? collect(),
        'buttons' => [
            ['label' => 'Book Appointment', 'url' => route('contact'), 'primary' => true],
            ['label' => 'Refer a Patient', 'url' => route('patient-information'), 'primary' => false],
        ],
    ])
@endsection

@section('content')
    {{-- Stats: below nav, light background --}}
    <section class="py-16 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 max-w-5xl mx-auto">
                @foreach($stats as $stat)
                    <div class="text-center p-6 lg:p-8 rounded-xl bg-white border border-gray-200 shadow-sm">
                        <p class="text-3xl sm:text-4xl lg:text-5xl font-bold text-ctc-blue">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-sm font-medium text-gray-600">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Services preview --}}
    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Our Services" subtitle="Comprehensive cardiothoracic care for adults and children." />
            <div class="grid gap-8 lg:grid-cols-12 items-stretch">
                @if(!empty($servicesImageUrl))
                    <div class="lg:col-span-4 lg:order-2">
                        <div class="h-full overflow-hidden rounded-[1.25rem] border border-gray-200 bg-white shadow-sm">
                            <div class="relative h-full bg-ctc-grey-light">
                                <img src="{{ $servicesImageUrl }}" alt="Our services" class="h-full w-full object-cover">

                                <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
                                    <a href="{{ route('services') }}"
                                       class="group inline-flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3.5 font-headline font-bold uppercase text-[0.62rem] tracking-[0.18em] text-white shadow-[0_18px_45px_rgba(0,0,0,0.35)] transition-all
                                              bg-[linear-gradient(135deg,rgba(26,26,104,0.95),rgba(98,163,161,0.92))]
                                              hover:brightness-105">
                                        <span class="inline-flex items-center gap-2">
                                            <span>View all services</span>
                                            <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.22)]"></span>
                                        </span>
                                        <svg class="w-4 h-4 opacity-90 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="{{ !empty($servicesImageUrl) ? 'lg:col-span-8' : 'lg:col-span-12' }}">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 auto-rows-fr h-full">
                        @foreach($services as $service)
                            <x-service-card :name="$service->name" :description="$service->description" :url="route('services') . '#' . $service->slug" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Team preview --}}
    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Our Team" subtitle="Dedicated surgeons and specialists committed to excellence." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($team as $member)
                    <x-team-card
                        :name="$member->name"
                        :title="$member->title"
                        :specialization="$member->specialization"
                        :bio="$member->bio"
                        :photo="$member->photo"
                    />
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('specialists') }}" class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                    Meet the full team
                </a>
            </div>
        </div>
    </section>

    {{-- Impact --}}
    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Our Impact in Africa" subtitle="The CTC is a regional leader in cardiothoracic surgery and training." />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>
                    The Cardiothoracic Centre at Tenwek Hospital has become a beacon of hope across East Africa and beyond.
                    We perform thousands of heart and chest surgeries each year, train the next generation of surgeons,
                    and partner with institutions worldwide to expand access to life-saving care. Our mission is to ensure
                    that no patient is denied treatment for lack of expertise or resources.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA Support --}}
    <x-cta-section
        title="Support the CTC"
        description="Your donation helps us provide surgery to those who cannot afford it and train more surgeons for Africa."
        buttonLabel="Ways to give"
        :buttonUrl="route('support')"
    />

    {{-- Latest news --}}
    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Latest News" subtitle="Updates, events, and announcements from the CTC." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($news as $article)
                    <x-news-card
                        :title="$article->title"
                        :excerpt="$article->excerpt"
                        :type="$article->type"
                        :date="$article->published_at"
                        :image="$article->featured_image"
                        :url="route('news.show', $article->slug)"
                    />
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('news') }}" class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                    View all news
                </a>
            </div>
        </div>
    </section>
@endsection
