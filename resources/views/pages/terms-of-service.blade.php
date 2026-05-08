@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')
    @include('components.page-banner', [
        'title' => 'Terms of Service',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl prose prose-lg text-gray-600">
                <p>
                    These Terms of Service govern use of the Cardiothoracic Centre (CTC) website. By using this website, you agree to these terms.
                </p>

                <h2>Medical information</h2>
                <p>
                    Content on this website is for general information only and does not replace professional medical advice. For urgent medical needs,
                    contact emergency services or Tenwek Hospital immediately.
                </p>

                <h2>Appointments and enquiries</h2>
                <p>
                    Submitting a form does not guarantee an appointment. Our team will review and respond as soon as possible.
                </p>

                <h2>Acceptable use</h2>
                <ul>
                    <li>Do not submit false, harmful, or unlawful content.</li>
                    <li>Do not attempt to disrupt the site or access restricted areas.</li>
                </ul>

                <h2>Changes</h2>
                <p>
                    We may update these terms to reflect service or legal changes. The latest version will be posted on this page.
                </p>
            </div>
        </div>
    </section>
@endsection

