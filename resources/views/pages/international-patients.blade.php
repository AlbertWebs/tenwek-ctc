@extends('layouts.app')

@section('title', 'International Patients')

@php($metaDescription = 'Information for international patients visiting Tenwek CTC: referrals, planning your travel, arrival guidance, and how to contact our team for support.')

@section('content')
    @include('components.page-banner', [
        'title' => 'International Patients',
        'subtitle' => config('ctc.hospital'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">
                <div class="max-w-3xl prose prose-lg text-gray-600">
                    <p>
                        We welcome patients travelling from outside Kenya for cardiothoracic consultation, surgery, and follow‑up care.
                        Our team can guide you through referrals, planning, and arrival at Tenwek Hospital.
                    </p>
                </div>

                <div class="mt-10 grid md:grid-cols-2 gap-8">
                    <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Before you travel</h2>
                        <ul class="mt-3 space-y-2 text-gray-600">
                            <li>Share your medical records, imaging, and recent test results.</li>
                            <li>Confirm appointment dates and estimated length of stay.</li>
                            <li>Ask about pre-travel requirements and medication planning.</li>
                        </ul>
                    </div>

                    <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">On arrival</h2>
                        <ul class="mt-3 space-y-2 text-gray-600">
                            <li>Check in at Tenwek Hospital and complete registration.</li>
                            <li>Meet your care coordinator and clinical team.</li>
                            <li>Complete evaluations needed before procedures.</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 p-6 rounded-xl bg-ctc-grey-light border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Need help planning your visit?</h2>
                    <p class="text-gray-600 mb-5">Contact our team and we’ll help you take the next step.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

