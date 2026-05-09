@extends('layouts.app')

@section('title', 'Training & Research')

@php($metaDescription = 'Training and research at Tenwek CTC: fellowship and rotations, clinical outcomes research, publications, and opportunities for collaboration.')

@section('content')
    @include('components.page-banner', [
        'title' => 'Training & Research',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'training_research',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2 max-w-6xl">
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Training</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        We train surgeons and clinicians through fellowship, rotations, and visiting programmes, building the next generation
                        of cardiothoracic specialists for Africa.
                    </p>
                    <a href="{{ route('training') }}" class="inline-flex items-center px-5 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                        Explore training
                    </a>
                </div>

                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Research</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Our research focuses on outcomes in resource-limited settings, congenital heart disease, valve disease, and the effectiveness
                        of surgical training, in collaboration with local and global partners.
                    </p>
                    <a href="{{ route('research') }}" class="inline-flex items-center px-5 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                        Explore research
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-cta-section
        title="Interested in training or collaboration?"
        description="Reach out for fellowship, rotation, research, and partnership inquiries."
        buttonLabel="Contact us"
        :buttonUrl="route('contact')"
    />
@endsection

