@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Patient Information',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <div class="space-y-16">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">How to Become a Patient</h2>
                    <p class="text-gray-600 leading-relaxed">Most patients are referred by a physician. If you or your doctor believe you need cardiothoracic evaluation, the first step is to have your referring physician contact us. We will review your records and guide you through the next steps.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Referral Process</h2>
                    <p class="text-gray-600 leading-relaxed">Referrals can be sent via email or post. Please include relevant medical records, imaging, and a referral letter. Our team will review and contact you or your physician to schedule an appointment or advise on further tests.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Preparing for Surgery</h2>
                    <p class="text-gray-600 leading-relaxed">You will receive specific instructions from our team regarding fasting, medications, and what to bring. Pre-operative testing and consultations are completed before your surgery date. We encourage you to ask any questions during your pre-op visit.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Hospital Stay</h2>
                    <p class="text-gray-600 leading-relaxed">Length of stay depends on your procedure and recovery. You will be cared for in dedicated wards with nursing and medical staff experienced in cardiothoracic patients. Family members can visit according to hospital policy.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Recovery</h2>
                    <p class="text-gray-600 leading-relaxed">We provide clear discharge instructions and follow-up plans. Rehabilitation and medication guidance will be given before you leave. Follow-up appointments are important for your long-term outcome.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">International Patients</h2>
                    <p class="text-gray-600 leading-relaxed">We welcome patients from other countries. Our team can assist with referral coordination, travel, and accommodation information. Please contact us in advance so we can help you plan your visit.</p>
                </div>
            </div>
        </div>
    </section>

    <x-cta-section
        title="Ready to refer or book?"
        description="Contact us for referrals or appointment inquiries."
        buttonLabel="Contact us"
        :buttonUrl="route('contact')"
    />
@endsection
