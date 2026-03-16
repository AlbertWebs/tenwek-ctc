@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.hero-section', [
        'title' => 'Cardiothoracic Centre',
        'subtitle' => 'Tenwek Hospital',
        'description' => 'Excellence in heart and chest surgery, training, and research in East Africa. We provide life-saving care and build the next generation of cardiothoracic surgeons.',
        'buttons' => [
            ['label' => 'Book Appointment', 'url' => route('contact'), 'primary' => true],
            ['label' => 'Refer a Patient', 'url' => route('patient-information'), 'primary' => false],
        ],
    ])

    {{-- Statistics --}}
    <section class="py-16 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($stats as $stat)
                    <x-stats-card :value="$stat['value']" :label="$stat['label']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Services preview --}}
    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Our Services" subtitle="Comprehensive cardiothoracic care for adults and children." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($services as $service)
                    <x-service-card :name="$service->name" :description="$service->description" :url="route('services') . '#' . $service->slug" />
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                    View all services
                </a>
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
                <a href="{{ route('team') }}" class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
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
                        :url="route('news')"
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
