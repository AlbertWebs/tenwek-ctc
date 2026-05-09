@extends('layouts.app')

@section('title', 'Patient Information')

@php($metaDescription = 'Patient information for Tenwek CTC: referrals, preparing for surgery, hospital stay, recovery, and guidance for international patients.')

@section('content')
    @include('components.page-banner', [
        'title' => 'Patient Information',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'patient_information',
    ])

    <section class="relative py-16 lg:py-20 overflow-hidden">
        {{-- Soft magenta-tinted backdrop --}}
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-ctc-magenta/[0.06] via-white to-ctc-blue/[0.04]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -top-24 right-0 h-80 w-80 rounded-full bg-ctc-magenta/10 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute bottom-0 -left-16 h-72 w-72 rounded-full bg-ctc-secondary/10 blur-3xl" aria-hidden="true"></div>

        <div class="container relative mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            {{-- Intro --}}
            <div class="rounded-3xl border border-ctc-magenta/20 bg-white/90 shadow-[0_24px_60px_rgba(184,50,128,0.08)] backdrop-blur-sm p-6 sm:p-10">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex h-2 w-2 rounded-full bg-ctc-magenta shadow-[0_0_0_6px_rgba(184,50,128,0.2)]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-magenta">For patients &amp; families</p>
                </div>
                <p class="mt-4 text-lg sm:text-xl font-headline font-semibold text-ctc-blue leading-snug">
                    Clear steps from referral to recovery—so you know what to expect at every stage.
                </p>
                <p class="mt-3 text-gray-600 leading-relaxed">
                    Whether you are coming from across town or from another country, our team is here to guide you with compassionate, specialist cardiothoracic care.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('book-appointment') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-ctc-magenta px-5 py-3 text-[11px] font-headline font-bold uppercase tracking-[0.16em] text-white shadow-[0_14px_40px_rgba(184,50,128,0.35)] transition-all hover:bg-ctc-magenta-dark hover:brightness-105">
                        Book appointment
                        <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 rounded-xl border-2 border-ctc-magenta/35 bg-white px-5 py-3 text-[11px] font-headline font-bold uppercase tracking-[0.16em] text-ctc-magenta transition-colors hover:border-ctc-magenta hover:bg-ctc-magenta/5">
                        Contact us
                    </a>
                    <a href="{{ route('international-patients') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-ctc-grey-light/80 px-5 py-3 text-[11px] font-headline font-bold uppercase tracking-[0.16em] text-ctc-blue transition-colors hover:border-ctc-magenta/30 hover:text-ctc-magenta-dark">
                        International patients
                    </a>
                </div>
            </div>

            {{-- Content blocks --}}
            <div class="mt-14 space-y-6">
                @foreach([
                    [
                        'title' => 'How to Become a Patient',
                        'body' => 'Most patients are referred by a physician. If you or your doctor believe you need cardiothoracic evaluation, the first step is to have your referring physician contact us. We will review your records and guide you through the next steps.',
                    ],
                    [
                        'title' => 'Referral Process',
                        'body' => 'Referrals can be sent via email or post. Please include relevant medical records, imaging, and a referral letter. Our team will review and contact you or your physician to schedule an appointment or advise on further tests.',
                    ],
                    [
                        'title' => 'Preparing for Surgery',
                        'body' => 'You will receive specific instructions from our team regarding fasting, medications, and what to bring. Pre-operative testing and consultations are completed before your surgery date. We encourage you to ask any questions during your pre-op visit.',
                    ],
                    [
                        'title' => 'Hospital Stay',
                        'body' => 'Length of stay depends on your procedure and recovery. You will be cared for in dedicated wards with nursing and medical staff experienced in cardiothoracic patients. Family members can visit according to hospital policy.',
                    ],
                    [
                        'title' => 'Recovery',
                        'body' => 'We provide clear discharge instructions and follow-up plans. Rehabilitation and medication guidance will be given before you leave. Follow-up appointments are important for your long-term outcome.',
                    ],
                    [
                        'title' => 'International Patients',
                        'body' => 'We welcome patients from other countries. Our team can assist with referral coordination, travel, and accommodation information. Please contact us in advance so we can help you plan your visit.',
                        'link' => route('international-patients'),
                        'linkLabel' => 'International patient guide',
                    ],
                ] as $block)
                    <article class="group rounded-2xl border border-gray-200/90 bg-white p-6 sm:p-8 shadow-sm transition-shadow hover:shadow-md hover:border-ctc-magenta/25">
                        <div class="flex gap-4">
                            <div class="hidden sm:block w-1 shrink-0 rounded-full bg-gradient-to-b from-ctc-magenta via-ctc-magenta-light to-ctc-secondary opacity-90 group-hover:opacity-100 transition-opacity" aria-hidden="true"></div>
                            <div class="min-w-0 flex-1">
                                <h2 class="text-xl sm:text-2xl font-headline font-extrabold tracking-tight text-ctc-blue after:mt-3 after:block after:h-1 after:w-14 after:rounded-full after:bg-gradient-to-r after:from-ctc-magenta after:to-ctc-magenta-light after:content-['']">
                                    {{ $block['title'] }}
                                </h2>
                                <p class="mt-4 text-gray-600 leading-relaxed">{{ $block['body'] }}</p>
                                @if(!empty($block['link']))
                                    <a href="{{ $block['link'] }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-ctc-magenta hover:text-ctc-magenta-dark">
                                        {{ $block['linkLabel'] }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Highlight strip --}}
            <div class="mt-14 rounded-2xl border border-ctc-magenta/25 bg-gradient-to-r from-ctc-magenta/10 via-white to-ctc-secondary/10 p-6 sm:p-8">
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-ctc-magenta">Questions?</p>
                <p class="mt-2 text-gray-700 leading-relaxed">
                    If anything is unclear, our patient coordination team can walk you through referrals, appointments, and what to bring on the day of your visit.
                </p>
                <a href="{{ route('contact') }}" class="mt-4 inline-flex items-center font-headline text-sm font-bold uppercase tracking-wider text-ctc-magenta hover:text-ctc-magenta-dark">
                    Get in touch →
                </a>
            </div>
        </div>
    </section>

    <x-cta-section
        title="Ready to refer or book?"
        description="Contact us for referrals or appointment inquiries."
        buttonLabel="Contact us"
        :buttonUrl="route('book-appointment')"
    />
@endsection
