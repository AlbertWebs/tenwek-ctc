@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Team',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
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
                    <p class="col-span-full text-gray-600">Team profiles will be listed here.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
