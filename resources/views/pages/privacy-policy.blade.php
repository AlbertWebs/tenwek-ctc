@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    @include('components.page-banner', [
        'title' => 'Privacy Policy',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'privacy_policy',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <article class="ctc-legal-prose max-w-4xl mx-auto text-gray-700">
                {!! $bodyHtml !!}
            </article>
        </div>
    </section>
@endsection
