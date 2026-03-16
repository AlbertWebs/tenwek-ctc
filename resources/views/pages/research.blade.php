@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Research',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Research Areas" />
            <div class="max-w-3xl prose prose-lg text-gray-600 mb-12">
                <p>Our research focuses on outcomes in cardiac and thoracic surgery in resource-limited settings, congenital heart disease, valve disease, and training effectiveness. We collaborate with universities and research institutions locally and internationally.</p>
            </div>

            <x-section-title title="Clinical Studies" />
            <div class="max-w-3xl prose prose-lg text-gray-600 mb-12">
                <p>We participate in and lead clinical studies that improve patient care and inform best practices. Studies are conducted with appropriate ethics approval and patient consent.</p>
            </div>

            <x-section-title title="Publications" />
            <div class="max-w-3xl prose prose-lg text-gray-600 mb-12">
                <p>Our team publishes in peer-reviewed journals and presents at regional and international conferences. Publications are listed in annual reports and can be requested through our contact channels.</p>
            </div>

            <x-section-title title="Annual Reports" />
            <div class="max-w-3xl prose prose-lg text-gray-600">
                <p>We produce annual reports summarizing our clinical activity, training, research, and outreach. These reports are available to partners and supporters. Contact us to request a copy.</p>
            </div>
        </div>
    </section>
@endsection
