@extends('layouts.app')

@section('title', 'Our Services')

@php($metaDescription = 'Explore cardiothoracic services at Tenwek CTC—cardiac surgery, thoracic surgery, and diagnostics, with patient-centered care and specialist expertise.')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Services',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-10 lg:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Clinical care</p>
                <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">Comprehensive heart & chest services</h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Explore our core service areas below. Each service is designed around safe, evidence‑based care — from diagnosis through surgery and follow‑up.
                </p>
            </div>

            <div class="mt-6 sticky top-16 z-10">
                <div class="rounded-2xl border border-gray-200 bg-white/90 backdrop-blur-md shadow-sm px-3 py-3">
                    <nav class="flex flex-wrap gap-2" aria-label="Service categories">
                        <a href="#cardiac_surgery" class="px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue bg-ctc-grey-light hover:bg-white border border-transparent hover:border-gray-200 transition-colors">
                            Cardiac
                        </a>
                        <a href="#thoracic_surgery" class="px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue bg-ctc-grey-light hover:bg-white border border-transparent hover:border-gray-200 transition-colors">
                            Thoracic
                        </a>
                        <a href="#diagnostics" class="px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue bg-ctc-grey-light hover:bg-white border border-transparent hover:border-gray-200 transition-colors">
                            Diagnostics
                        </a>
                        <span class="ml-auto hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-[0.18em] text-white
                                     bg-[linear-gradient(135deg,rgba(26,26,104,0.95),rgba(98,163,161,0.92))]">
                            <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.22)]"></span>
                            Jump to service
                        </span>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 scroll-mt-24" id="cardiac_surgery">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Cardiac Surgery" subtitle="Surgical care for heart conditions in adults and children." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
                @foreach($cardiac as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                        :url="route('services') . '#' . $service->slug"
                        :detailUrl="route('services.show', $service)"
                        :id="$service->slug"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light scroll-mt-24" id="thoracic_surgery">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Thoracic Surgery" subtitle="Surgery for lung, chest wall, and mediastinal conditions." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
                @foreach($thoracic as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                        :url="route('services') . '#' . $service->slug"
                        :detailUrl="route('services.show', $service)"
                        :id="$service->slug"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 scroll-mt-24" id="diagnostics">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Diagnostics" subtitle="Imaging and testing for accurate diagnosis." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
                @foreach($diagnostics as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                        :url="route('services') . '#' . $service->slug"
                        :detailUrl="route('services.show', $service)"
                        :id="$service->slug"
                    />
                @endforeach
            </div>
        </div>
    </section>
@endsection
