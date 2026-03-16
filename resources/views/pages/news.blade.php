@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'News & Events',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articles as $article)
                    <x-news-card
                        :title="$article->title"
                        :excerpt="$article->excerpt"
                        :type="$article->type"
                        :date="$article->published_at"
                        :url="route('news')"
                    />
                @empty
                    <p class="col-span-full text-gray-600">No articles yet. Check back soon.</p>
                @endforelse
            </div>

            @if($articles->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
