@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Training',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10 max-w-5xl">
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Cardiothoracic Fellowship</h2>
                    <p class="text-gray-600 leading-relaxed">Our fellowship program trains surgeons in adult and pediatric cardiac surgery and thoracic surgery. Fellows gain hands-on experience in a high-volume center and participate in research and teaching.</p>
                </div>
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Resident Training</h2>
                    <p class="text-gray-600 leading-relaxed">General surgery and other residents rotate through the CTC to learn the basics of cardiothoracic care and assessment. These rotations help prepare future specialists and improve referral practices.</p>
                </div>
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Visiting Surgeons Program</h2>
                    <p class="text-gray-600 leading-relaxed">Surgeons from other institutions can spend time at the CTC to observe, assist, and learn. We welcome short-term visitors who wish to expand their skills or explore partnership opportunities.</p>
                </div>
                <div class="p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Medical Student Rotations</h2>
                    <p class="text-gray-600 leading-relaxed">Medical students can complete elective rotations in cardiothoracic surgery. These rotations offer exposure to the specialty and to mission-based care in a resource-conscious setting.</p>
                </div>
            </div>
        </div>
    </section>

    <x-cta-section
        title="Interested in training with us?"
        description="Contact us for fellowship and rotation inquiries."
        buttonLabel="Contact us"
        :buttonUrl="route('contact')"
    />
@endsection
