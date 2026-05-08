@extends('layouts.app')

@section('title', 'History')

@section('content')
    @include('components.page-banner', [
        'title' => 'History',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12 items-start">
                <div class="lg:col-span-5">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">A history of excellence</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                        Milestones that shaped the Cardiothoracic Centre
                    </h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Explore key moments in the growth of the CTC — from early vision and facility development to training and regional impact.
                    </p>
                    <div class="mt-8 rounded-2xl border border-gray-200 bg-ctc-grey-light p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">Want to refer a patient?</p>
                        <p class="mt-3 text-sm text-gray-600">We’ll guide you on records, next steps, and appointment planning.</p>
                        <a href="{{ route('patient-information') }}" class="mt-5 inline-flex items-center rounded-xl bg-ctc-blue px-5 py-3 text-[11px] font-bold uppercase tracking-[0.18em] text-white hover:bg-ctc-blue-dark transition-colors">
                            Patient information
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6 sm:p-8">
                        <ol class="relative border-l border-ctc-accent/35 pl-6 space-y-8">
                            @forelse($milestones as $m)
                                <li class="relative">
                                    <span class="absolute -left-[0.53rem] top-1.5 h-4 w-4 rounded-full bg-ctc-accent shadow-[0_0_0_6px_rgba(228,195,115,0.12)]"></span>
                                    <div class="flex flex-wrap items-baseline gap-3">
                                        @if($m->year)
                                            <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">{{ $m->year }}</span>
                                        @endif
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $m->title }}</h3>
                                    </div>
                                    @if($m->description)
                                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $m->description }}</p>
                                    @endif
                                </li>
                            @empty
                                <li class="text-gray-600">Milestones will appear here once added in the admin panel.</li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

