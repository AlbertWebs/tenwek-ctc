@extends('layouts.app')

@section('title', 'Fellowship & Rotations')

@section('content')
    @include('components.page-banner', [
        'title' => 'Fellowship & Rotations',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'training_fellowship_rotations',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-7">
                    <p class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)]"></span>
                        Structured training
                    </p>
                    <h2 class="mt-4 text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900">
                        Train with hands-on exposure, mentorship, and outcomes-driven practice.
                    </h2>
                    <p class="mt-4 text-base sm:text-lg text-gray-600 leading-relaxed">
                        Our fellowship and rotation pathways are designed for clinicians seeking supervised cardiothoracic experience in a high-volume centre.
                        Training is integrated with multidisciplinary perioperative care and opportunities to contribute to quality improvement and research.
                    </p>

                    <div class="mt-8 grid sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Focus areas</p>
                            <ul class="mt-3 space-y-2 text-sm text-gray-700">
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-emerald-600 shrink-0"></span>Adult cardiac surgery</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-emerald-600 shrink-0"></span>Paediatric / congenital heart care</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-emerald-600 shrink-0"></span>Thoracic surgery</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-emerald-600 shrink-0"></span>ICU & perioperative pathways</li>
                            </ul>
                        </div>

                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">What to include</p>
                            <ul class="mt-3 space-y-2 text-sm text-gray-700">
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-ctc-blue shrink-0"></span>CV and training level</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-ctc-blue shrink-0"></span>Desired dates & duration</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-ctc-blue shrink-0"></span>Areas of interest</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-ctc-blue shrink-0"></span>Institutional letter (if applicable)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-10 rounded-2xl border border-emerald-200 bg-emerald-50 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-900">Next step</p>
                        <p class="mt-2 text-sm text-emerald-900/90">
                            Send an enquiry and we’ll guide you to the right pathway and any requirements relevant to your stage of training.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                                Contact us
                            </a>
                            <a href="{{ route('training') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold border border-emerald-200 bg-white/60 text-emerald-900 hover:bg-white transition-colors">
                                Back to Training overview
                            </a>
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-5 space-y-4">
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Also explore</p>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Related pages</h3>
                            <p class="mt-2 text-sm text-gray-600">More context for applicants and partners.</p>
                        </div>
                        <div class="border-t border-gray-200 divide-y divide-gray-200">
                            <a href="{{ route('research') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">Research</p>
                                <p class="mt-1 text-xs text-gray-600">Clinical outcomes, studies, and collaboration.</p>
                            </a>
                            <a href="{{ route('services') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">Services</p>
                                <p class="mt-1 text-xs text-gray-600">Areas where trainees gain exposure.</p>
                            </a>
                            <a href="{{ route('specialists') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">Specialists</p>
                                <p class="mt-1 text-xs text-gray-600">Meet the faculty and multidisciplinary team.</p>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-amber-200 bg-amber-50 shadow-sm p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-900">Support training</p>
                        <h3 class="mt-2 text-lg font-semibold text-gray-900">Invest in capacity</h3>
                        <p class="mt-2 text-sm text-gray-700">Your partnership helps build sustainable cardiothoracic care across the region.</p>
                        <div class="mt-4">
                            <a href="{{ route('support') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                                Support the CTC
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

