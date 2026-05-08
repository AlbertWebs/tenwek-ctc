@extends('layouts.app')

@section('title', 'Publications')

@section('content')
    @include('components.page-banner', [
        'title' => 'Publications',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-7">
                    <p class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                        Research output
                    </p>
                    <h2 class="mt-4 text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900">
                        Publications and presentations from Tenwek CTC.
                    </h2>
                    <p class="mt-4 text-base sm:text-lg text-gray-600 leading-relaxed">
                        Our team contributes to peer-reviewed literature and conference presentations focused on improving cardiothoracic outcomes in
                        resource-limited settings. If you’re looking for a specific publication list, we can share the most recent compilation on request.
                    </p>

                    <div class="mt-8 grid sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Common topics</p>
                            <ul class="mt-3 space-y-2 text-sm text-gray-700">
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)] shrink-0"></span>Congenital heart disease</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)] shrink-0"></span>Valve disease & rheumatic heart disease</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)] shrink-0"></span>Perioperative pathways & ICU outcomes</li>
                                <li class="flex gap-2"><span class="mt-2 h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)] shrink-0"></span>Training effectiveness</li>
                            </ul>
                        </div>
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">For collaborators</p>
                            <p class="mt-3 text-sm text-gray-700">
                                We welcome outcomes research collaborations that improve care delivery, surgical access, and training models for Africa.
                            </p>
                            <div class="mt-4 h-1 w-12 rounded-full bg-ctc-blue"></div>
                        </div>
                    </div>

                    <div class="mt-10 rounded-2xl border border-amber-200 bg-amber-50 p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-900">Request a publication list</p>
                        <p class="mt-2 text-sm text-amber-900/90">
                            Contact us and we’ll share the latest list of publications and conference abstracts, plus any partnership information you need.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                                Contact us
                            </a>
                            <a href="{{ route('research') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold border border-amber-200 bg-white/60 text-amber-900 hover:bg-white transition-colors">
                                Back to Research overview
                            </a>
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-5 space-y-4">
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Explore</p>
                            <h3 class="mt-2 text-lg font-semibold text-gray-900">Next steps</h3>
                            <p class="mt-2 text-sm text-gray-600">Related pages that support research and training.</p>
                        </div>
                        <div class="border-t border-gray-200 divide-y divide-gray-200">
                            <a href="{{ route('training') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">Training</p>
                                <p class="mt-1 text-xs text-gray-600">Fellowship, rotations, and capacity building.</p>
                            </a>
                            <a href="{{ route('training-research') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">Training & Research hub</p>
                                <p class="mt-1 text-xs text-gray-600">An overview of both areas.</p>
                            </a>
                            <a href="{{ route('news') }}" class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                                <p class="text-sm font-semibold text-gray-900">News & Media</p>
                                <p class="mt-1 text-xs text-gray-600">Updates from the centre.</p>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 shadow-sm p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-900">Partnership</p>
                        <h3 class="mt-2 text-lg font-semibold text-gray-900">Collaborate with Tenwek CTC</h3>
                        <p class="mt-2 text-sm text-gray-700">Explore ways to partner on training, research, and access to care.</p>
                        <div class="mt-4">
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center px-5 py-3 rounded-lg font-semibold bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                                Start a conversation
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

