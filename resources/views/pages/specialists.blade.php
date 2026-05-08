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
            <div class="max-w-3xl prose prose-lg text-gray-600 mb-10">
                <p>
                    Meet the surgeons and specialist clinicians who provide cardiothoracic care at Tenwek. Our team combines
                    deep experience with a commitment to compassionate, safe, and evidence-based treatment.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($team as $member)
                    <x-team-card
                        :name="$member->name"
                        :title="$member->title"
                        :specialization="$member->specialization"
                        :bio="$member->bio"
                        :photo="$member->photo"
                    />
                @empty
                    <p class="col-span-full text-gray-600">Specialist profiles will be listed here.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

