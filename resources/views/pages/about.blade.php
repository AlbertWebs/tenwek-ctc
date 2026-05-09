@extends('layouts.app')

@section('title', 'About CTC')

@section('content')
    @include('components.page-banner', [
        'title' => 'About the Centre',
        'subtitle' => config('ctc.hospital'),
        'bannerKey' => 'about',
    ])

    {{-- Intro + at-a-glance --}}
    <section class="py-14 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12 items-center">
                <div class="lg:col-span-6">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">{{ $whoWeAre['kicker'] ?? 'Who we are' }}</p>
                    <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-headline font-extrabold tracking-tight text-ctc-blue">
                        {{ $whoWeAre['heading'] ?? 'Specialist heart & chest care, grounded in compassion' }}
                    </h2>
                    <div class="mt-4 prose prose-slate max-w-none prose-p:text-gray-700 prose-p:leading-relaxed">
                        {!! $whoWeAre['body'] ?? e('The Cardiothoracic Centre (CTC) at Tenwek Hospital provides comprehensive care for adult and pediatric patients with cardiac and thoracic conditions, from diagnosis through surgery and follow‑up.') !!}
                    </div>
                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li class="flex gap-3">
                            <span class="mt-1.5 h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.18)]"></span>
                            <span class="leading-relaxed">{{ $whoWeAre['bullets'][0] ?? 'Integrated teams across surgery, anesthesia, ICU, nursing, and diagnostics.' }}</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-1.5 h-2 w-2 rounded-full bg-ctc-secondary shadow-[0_0_0_4px_rgba(98,163,161,0.18)]"></span>
                            <span class="leading-relaxed">{{ $whoWeAre['bullets'][1] ?? 'Focused on safe, evidence‑based care with long‑term follow‑up.' }}</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-1.5 h-2 w-2 rounded-full bg-ctc-blue/70 shadow-[0_0_0_4px_rgba(18,18,74,0.14)]"></span>
                            <span class="leading-relaxed">{{ $whoWeAre['bullets'][2] ?? 'Training and mentorship that strengthens local capacity across Africa.' }}</span>
                        </li>
                    </ul>
                </div>

                <div class="lg:col-span-6">
                    <div class="grid gap-4 sm:grid-cols-12 items-stretch">
                        <div class="sm:col-span-7 rounded-3xl overflow-hidden border border-gray-200 bg-ctc-grey-light shadow-sm">
                            <div class="relative h-full min-h-[22rem] sm:min-h-0 overflow-hidden" data-ctc-parallax="0.11">
                                <img
                                    src="{{ $whoWeAre['images']['main'] ?? config('ctc.placeholder_images.facility') }}"
                                    alt="CTC facility"
                                    class="absolute inset-0 h-full w-full object-cover object-top scale-105"
                                    loading="lazy"
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-5 grid gap-4">
                            <div class="rounded-3xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                                <div class="aspect-square overflow-hidden" data-ctc-parallax="0.08">
                                <img
                                    src="{{ $whoWeAre['images']['side_1'] ?? config('ctc.placeholder_images.team') }}"
                                    alt="Care team"
                                        class="h-full w-full object-cover scale-105"
                                        loading="lazy"
                                    />
                                </div>
                            </div>
                            <div class="rounded-3xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                                <div class="aspect-square overflow-hidden" data-ctc-parallax="0.08">
                                <img
                                    src="{{ $whoWeAre['images']['side_2'] ?? config('ctc.placeholder_images.care') }}"
                                    alt="Patient care"
                                        class="h-full w-full object-cover scale-105"
                                        loading="lazy"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4" data-ctc-stagger="0.08">
                        @php
                            $aboutStats = collect([
                                ['value' => 'Comprehensive', 'label' => 'Cardiac + thoracic services'],
                                ['value' => 'Training', 'label' => 'Building regional capacity'],
                                ['value' => 'Team-based', 'label' => 'Coordinated perioperative care'],
                                ['value' => 'Follow‑up', 'label' => 'Continuity after surgery'],
                            ]);
                        @endphp
                        @foreach($aboutStats as $stat)
                            <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-5">
                                <p class="text-lg sm:text-xl font-extrabold text-ctc-blue font-headline">{{ $stat['value'] }}</p>
                                <p class="mt-1 text-sm text-gray-600 leading-snug">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    {{-- Values --}}
    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.section-title', [
                'title' => 'What guides our care',
                'subtitle' => 'A few principles that shape how we serve patients, families, and referring clinicians.',
            ])

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-ctc-stagger="0.1">
                @php
                    $values = (isset($coreValues) && $coreValues->count())
                        ? $coreValues->map(fn ($v) => ['title' => $v->title, 'desc' => $v->description])
                        : collect([
                            ['title' => 'Compassion', 'desc' => 'We treat every patient with dignity, empathy, and respect.'],
                            ['title' => 'Excellence', 'desc' => 'We pursue high standards and continuous improvement.'],
                            ['title' => 'Teamwork', 'desc' => 'Care is coordinated across disciplines and services.'],
                            ['title' => 'Stewardship', 'desc' => 'We use resources wisely to help more people safely.'],
                        ]);

                    $accents = collect([
                        ['bg' => 'bg-ctc-accent/15', 'ring' => 'ring-ctc-accent/25', 'dot' => 'bg-ctc-accent'],
                        ['bg' => 'bg-ctc-secondary/12', 'ring' => 'ring-ctc-secondary/25', 'dot' => 'bg-ctc-secondary'],
                        ['bg' => 'bg-ctc-blue/10', 'ring' => 'ring-ctc-blue/20', 'dot' => 'bg-ctc-blue'],
                        ['bg' => 'bg-ctc-accent/12', 'ring' => 'ring-ctc-accent/20', 'dot' => 'bg-ctc-accent'],
                    ]);
                @endphp

                @foreach($values as $i => $v)
                    @php $a = $accents[$i % $accents->count()]; @endphp
                    <div class="ctc-card-tilt group relative rounded-2xl bg-white border border-gray-200 shadow-sm p-6 overflow-hidden hover:shadow-lg transition-shadow duration-500">
                        <div class="absolute inset-x-0 top-0 h-1 {{ $a['dot'] }}"></div>
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 h-11 w-11 rounded-2xl {{ $a['bg'] }} ring-1 {{ $a['ring'] }} flex items-center justify-center">
                                <span class="text-sm font-extrabold font-headline text-ctc-blue">
                                    {{ mb_substr($v['title'], 0, 1) }}
                                </span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-headline font-extrabold text-ctc-blue leading-tight">{{ $v['title'] }}</p>
                                @if(!empty($v['desc']))
                                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $v['desc'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Mission & Vision (subtle gold accents) --}}
    <section class="py-16 lg:py-20 bg-ctc-grey-light w-full">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full">
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">
                    {{ $purpose['kicker'] ?? 'Purpose' }}
                </p>

                <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                    {{ $purpose['heading'] ?? 'Mission & Vision' }}
                </h2>
            </div>

            <div class="mt-8 grid gap-8 w-full lg:grid-cols-12 items-stretch">
                
                <!-- Left Cards -->
                <div class="grid gap-8 lg:col-span-5">
                    
                    <div class="rounded-2xl bg-white border border-ctc-accent/25 shadow-sm p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">
                            {{ $purpose['mission']['kicker'] ?? 'Mission' }}
                        </p>

                        <h3 class="mt-2 text-xl font-semibold text-ctc-blue">
                            {{ $purpose['mission']['title'] ?? 'Excellent, compassionate care' }}
                        </h3>

                        <div class="mt-3 prose prose-sm max-w-none text-gray-600 leading-relaxed prose-p:my-2 prose-headings:font-headline prose-headings:text-ctc-blue prose-a:text-ctc-secondary">
                            @if(!empty($purpose['mission']['body']))
                                {!! $purpose['mission']['body'] !!}
                            @else
                                <p>To provide excellent, compassionate cardiothoracic care to all who need it, and to train the next generation of surgeons and healthcare workers for Africa.</p>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-secondary">
                            {{ $purpose['vision']['kicker'] ?? 'Vision' }}
                        </p>

                        <h3 class="mt-2 text-xl font-semibold text-ctc-blue">
                            {{ $purpose['vision']['title'] ?? 'Access for every patient' }}
                        </h3>

                        <div class="mt-3 prose prose-sm max-w-none text-gray-600 leading-relaxed prose-p:my-2 prose-headings:font-headline prose-headings:text-ctc-blue prose-a:text-ctc-secondary">
                            @if(!empty($purpose['vision']['body']))
                                {!! $purpose['vision']['body'] !!}
                            @else
                                <p>A region where every person has access to life‑saving heart and chest surgery, delivered by well‑trained local teams.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Feature Panel -->
                <div class="rounded-2xl bg-white border border-ctc-blue/15 shadow-sm p-7 relative overflow-hidden lg:col-span-7">

                    <div 
                        class="absolute inset-0 opacity-[0.8]" 
                        aria-hidden="true"
                        style="
                            background:
                            radial-gradient(600px 260px at 20% 15%, rgba(98,163,161,0.22), transparent 60%),
                            radial-gradient(520px 240px at 84% 28%, rgba(228,195,115,0.20), transparent 62%);
                        ">
                    </div>

                    <div class="relative flex flex-col h-full">

                        <div class="flex-1 grid gap-6 lg:grid-cols-12 items-center">

                            <div class="lg:col-span-7">
                                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-blue/75">
                                    {{ $purpose['right']['kicker'] ?? 'How we work' }}
                                </p>

                                <h3 class="mt-2 text-xl font-semibold text-ctc-blue">
                                    {{ $purpose['right']['title'] ?? 'What patients can expect' }}
                                </h3>

                                <div class="mt-3 prose prose-sm max-w-none text-gray-600 leading-relaxed prose-p:my-2 prose-headings:font-headline prose-headings:text-ctc-blue prose-a:text-ctc-secondary">
                                    @if(!empty($purpose['right']['body']))
                                        {!! $purpose['right']['body'] !!}
                                    @else
                                        <p>Clear communication, safety‑first protocols, and coordinated care from referral through recovery.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="lg:col-span-5">
                                <div class="rounded-2xl overflow-hidden ring-1 ring-white/25 bg-white/10">

                                    <div class="aspect-[4/3] lg:aspect-[3/4]">
                                        <img
                                            src="{{ $purpose['right']['image'] ?? config('ctc.placeholder_images.care') }}"
                                            alt=""
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                        />
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="mt-6 grid sm:grid-cols-3 gap-3 text-sm text-gray-700">

                            <div class="rounded-xl bg-white/60 ring-1 ring-white/30 px-4 py-3">
                                <p class="font-semibold text-ctc-blue underline decoration-ctc-accent/70 decoration-2 underline-offset-4">
                                    Clear communication
                                </p>

                                <p class="mt-1 text-gray-600 text-[0.9rem] leading-relaxed">
                                    We explain options and next steps.
                                </p>
                            </div>

                            <div class="rounded-xl bg-white/60 ring-1 ring-white/30 px-4 py-3">
                                <p class="font-semibold text-ctc-blue underline decoration-ctc-accent/70 decoration-2 underline-offset-4">
                                    Safety-first
                                </p>

                                <p class="mt-1 text-gray-600 text-[0.9rem] leading-relaxed">
                                    Protocols and teamwork across care.
                                </p>
                            </div>

                            <div class="rounded-xl bg-white/60 ring-1 ring-white/30 px-4 py-3">
                                <p class="font-semibold text-ctc-blue underline decoration-ctc-accent/70 decoration-2 underline-offset-4">
                                    Continuity
                                </p>

                                <p class="mt-1 text-gray-600 text-[0.9rem] leading-relaxed">
                                    Follow-up from surgery to recovery.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('components.cta-section', [
        'title' => 'Need help or want to partner?',
        'description' => 'For referrals, international patient enquiries, training opportunities, or partnership conversations, reach out to our team.',
        'buttonLabel' => 'Contact us',
        'buttonUrl' => route('contact'),
    ])
@endsection
