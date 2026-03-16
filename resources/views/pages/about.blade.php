@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'About the Centre',
        'subtitle' => config('ctc.hospital'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Overview of the Centre" />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>
                    The Cardiothoracic Centre (CTC) at Tenwek Hospital is a leading center for heart and chest surgery in East Africa.
                    We provide comprehensive care for adult and pediatric patients with cardiac and thoracic conditions,
                    from diagnosis through surgery and follow-up. Our team is committed to clinical excellence, education, and research.
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="History of the CTC" />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>
                    The CTC was established to address the critical need for cardiothoracic surgery in the region.
                    Over the years, we have grown from a small program to a full-service center performing thousands of
                    procedures annually. Our history is marked by partnerships with international organizations and
                    a steadfast focus on training African surgeons to serve their own communities.
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Mission & Vision" />
            <div class="grid md:grid-cols-2 gap-10 max-w-4xl">
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-semibold text-ctc-blue mb-2">Our Mission</h3>
                    <p class="text-gray-600">To provide excellent, compassionate cardiothoracic care to all who need it, and to train the next generation of surgeons and healthcare workers for Africa.</p>
                </div>
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-semibold text-ctc-blue mb-2">Our Vision</h3>
                    <p class="text-gray-600">A region where every person has access to life-saving heart and chest surgery, delivered by well-trained local teams.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Global Partnerships" />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>
                    We work with hospitals, universities, and NGOs around the world to strengthen our clinical programs,
                    support training, and advance research. These partnerships bring expertise, equipment, and funding
                    that help us serve more patients and train more surgeons. We are grateful to every partner who shares
                    our commitment to transforming cardiothoracic care in Africa.
                </p>
            </div>
        </div>
    </section>
@endsection
