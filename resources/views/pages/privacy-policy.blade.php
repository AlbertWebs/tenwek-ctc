@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    @include('components.page-banner', [
        'title' => 'Privacy Policy',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl prose prose-lg text-gray-600">
                <p>
                    This Privacy Policy explains how the Cardiothoracic Centre (CTC) at Tenwek Hospital collects, uses, and protects information
                    submitted through this website.
                </p>

                <h2>Information we collect</h2>
                <ul>
                    <li>Contact details you submit (e.g. name, email, phone).</li>
                    <li>Messages and enquiry details you share through forms.</li>
                    <li>Basic technical data (e.g. browser type) for site performance and security.</li>
                </ul>

                <h2>How we use information</h2>
                <ul>
                    <li>To respond to enquiries, requests, and referrals.</li>
                    <li>To improve our services and website experience.</li>
                    <li>For safety, fraud prevention, and compliance where required.</li>
                </ul>

                <h2>Sharing</h2>
                <p>
                    We do not sell personal information. We may share information internally with relevant clinical or administrative teams to respond to your request,
                    and with service providers only when needed to operate this website.
                </p>

                <h2>Security</h2>
                <p>
                    We apply reasonable technical and organisational measures to protect submitted information. No method of transmission or storage is 100% secure;
                    if you have concerns, please contact us directly.
                </p>

                <h2>Contact</h2>
                <p>
                    For privacy questions, please email <a href="mailto:{{ config('ctc.contact.email') }}">{{ config('ctc.contact.email') }}</a>.
                </p>
            </div>
        </div>
    </section>
@endsection

