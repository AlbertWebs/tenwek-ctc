@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')
    @include('components.page-banner', [
        'title' => 'Terms of Service',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'terms_of_service',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <article class="ctc-legal-prose max-w-4xl mx-auto text-gray-700">
                {!! $bodyHtml !!}
            </article>
        </div>
    </section>
@endsection
