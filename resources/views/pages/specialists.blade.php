@extends('layouts.app')

@section('title', 'Our Specialists')

@php($metaDescription = 'Meet the cardiothoracic surgeons and specialist clinicians at Tenwek CTC, providing compassionate, safe, evidence-based heart and chest care.')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Specialists',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12 items-start mb-10">
                <div class="lg:col-span-7">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Clinical team</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                        Experience, compassion, and safe outcomes
                    </h2>
                    <p class="mt-4 text-gray-600 leading-relaxed max-w-2xl">
                        Meet the surgeons and specialist clinicians who provide cardiothoracic care at Tenwek. Our team combines
                        deep experience with a commitment to compassionate, safe, and evidence‑based treatment.
                    </p>
                </div>
                <div class="lg:col-span-5">
                    <div class="rounded-2xl border border-gray-200 bg-ctc-grey-light p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">Appointments & referrals</p>
                        <p class="mt-3 text-sm text-gray-600">
                            For appointments, referrals, and international patient support, contact our team and we’ll guide you on next steps.
                        </p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-[11px] font-bold uppercase tracking-[0.18em] text-white
                                      bg-[linear-gradient(135deg,rgba(26,26,104,0.95),rgba(98,163,161,0.92))] hover:brightness-105 transition-all">
                                Contact us
                                <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.22)]"></span>
                            </a>
                            <a href="{{ route('patient-information') }}"
                               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue hover:bg-white/70 transition-colors">
                                Patient info
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8 auto-rows-fr">
                @forelse($team as $member)
                    <x-team-card
                        :name="$member->name"
                        :title="$member->title"
                        :specialization="$member->specialization"
                        :bio="$member->bio"
                        :photo="$member->photo"
                        :url="route('specialists.show', $member)"
                    />
                @empty
                    <p class="col-span-full text-gray-600">Specialist profiles will be listed here.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

