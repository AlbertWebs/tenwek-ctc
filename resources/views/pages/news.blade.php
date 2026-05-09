@extends('layouts.news-playful')

@section('title', 'News & Media')

@section('news_playful_main')
    <header class="mb-8 lg:mb-10">
        <span class="inline-block -rotate-1 rounded-2xl bg-gradient-to-r from-ctc-accent/30 to-ctc-secondary/25 px-4 py-2 text-[11px] font-extrabold uppercase tracking-[0.22em] text-ctc-blue shadow-sm">
            Fresh from Tenwek
        </span>
        <h1 class="mt-5 font-headline text-3xl font-extrabold tracking-tight text-ctc-blue sm:text-4xl lg:text-[2.5rem] lg:leading-[1.1]">
            News &amp; Events
        </h1>
        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-gray-600">
            Updates, symposiums, and human stories from the Cardiothoracic Centre. Scroll the feed, dig into the sidebar anytime.
        </p>
    </header>

    <div class="grid gap-5 sm:grid-cols-2">
        @forelse($articles as $newsItem)
            <div class="ctc-news-bouncy-card h-full">
                <x-news-card
                    :title="$newsItem->title"
                    :excerpt="$newsItem->excerpt"
                    :type="$newsItem->type"
                    :date="$newsItem->published_at"
                    :image="$newsItem->featured_image"
                    :url="route('news.show', $newsItem->slug)"
                />
            </div>
        @empty
            <div class="col-span-full rounded-3xl border-2 border-dashed border-ctc-secondary/40 bg-ctc-grey-light/50 px-6 py-16 text-center">
                <p class="text-lg font-semibold text-gray-700">No articles yet</p>
                <p class="mt-2 text-gray-600">Check back soon for stories from the CTC.</p>
            </div>
        @endforelse
    </div>

    @if($articles->hasPages())
        <div class="mt-10 flex justify-center rounded-2xl bg-ctc-grey-light/60 p-4">
            {{ $articles->links() }}
        </div>
    @endif
@endsection
