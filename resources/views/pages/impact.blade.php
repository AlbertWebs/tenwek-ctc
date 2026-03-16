@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Impact',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Patient Stories" />
            <div class="max-w-3xl prose prose-lg text-gray-600 mb-12">
                <p>Every surgery has a story. Our patients come from across Kenya and the region—children with congenital heart defects, adults with valve disease or coronary disease, and those needing thoracic surgery. Their stories of hope and healing drive our mission. Patient story features will be shared here and in our communications.</p>
            </div>

            <x-section-title title="Milestones" />
            <ul class="max-w-2xl space-y-4 text-gray-600">
                <li class="flex gap-3"><span class="text-ctc-blue font-semibold">5,000+</span> Open heart surgeries performed</li>
                <li class="flex gap-3"><span class="text-ctc-blue font-semibold">50+</span> Surgeons trained through fellowship and visiting programs</li>
                <li class="flex gap-3"><span class="text-ctc-blue font-semibold">15+</span> Countries represented by our patients</li>
                <li class="flex gap-3"><span class="text-ctc-blue font-semibold">25+</span> Years of cardiothoracic service at Tenwek</li>
            </ul>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Global Impact" />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>The CTC’s impact extends beyond our campus. Our graduates serve in hospitals across East Africa and beyond. Our partnerships bring expertise and resources that benefit the wider region. By training local surgeons and maintaining high standards of care, we contribute to a sustainable model of cardiothoracic care for Africa.</p>
            </div>
        </div>
    </section>
@endsection
