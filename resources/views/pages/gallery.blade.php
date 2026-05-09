@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    @include('components.page-banner', [
        'title' => 'Gallery',
        'subtitle' => config('ctc.name'),
        'bannerKey' => 'gallery',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-ctc-accent">Moments</p>
                <h2 class="mt-3 text-2xl sm:text-3xl font-headline font-extrabold tracking-tight text-ctc-blue">
                    Life at the centre
                </h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    A visual look at care, teamwork, and the place we serve from. Images are managed in the admin panel.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($items as $item)
                    <figure class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                        <a
                            href="{{ $item->resolvedImageUrl() }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block aspect-[4/3] bg-ctc-grey-light"
                        >
                            <img
                                src="{{ $item->resolvedImageUrl() }}"
                                alt="{{ $item->title }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                loading="lazy"
                            >
                        </a>
                        <figcaption class="p-5">
                            <h3 class="text-base font-semibold text-gray-900">{{ $item->title }}</h3>
                            @if($item->caption)
                                <div class="mt-2 prose prose-sm max-w-none text-gray-600 prose-p:my-1 prose-a:text-ctc-secondary">
                                    {!! $item->caption !!}
                                </div>
                            @endif
                        </figcaption>
                    </figure>
                @empty
                    <div class="col-span-full rounded-3xl border-2 border-dashed border-ctc-secondary/40 bg-ctc-grey-light/50 px-6 py-16 text-center">
                        <p class="text-lg font-semibold text-gray-700">Gallery coming soon</p>
                        <p class="mt-2 text-gray-600">Check back for photos from the CTC.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
