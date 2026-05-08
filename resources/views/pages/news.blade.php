@extends('layouts.app')

@section('title', 'News & Media')

@section('content')
    @include('components.page-banner', [
        'title' => 'News & Events',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12 items-start">
                {{-- Main list (independent scroll on desktop) --}}
                <div class="lg:col-span-8">
                    <div class="lg:h-[calc(100vh-14rem)] lg:overflow-auto lg:pr-2">
                        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
                            @forelse($articles as $article)
                                <x-news-card
                                    :title="$article->title"
                                    :excerpt="$article->excerpt"
                                    :type="$article->type"
                                    :date="$article->published_at"
                                    :image="$article->featured_image"
                                    :url="route('news.show', $article->slug)"
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
                </div>

                {{-- Sidebar (independent scroll on desktop) --}}
                <aside class="lg:col-span-4">
                    <div class="lg:h-[calc(100vh-14rem)] lg:overflow-auto lg:pl-2">
                        <div class="space-y-6">
                            <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ctc-secondary">Need help?</p>
                                <h3 class="mt-3 text-lg font-bold text-gray-900">Talk to the team</h3>
                                <p class="mt-2 text-sm text-gray-600">For appointments, referrals, and enquiries.</p>
                                <a href="{{ route('contact') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-ctc-blue px-5 py-3 text-[11px] font-bold uppercase tracking-[0.18em] text-white hover:bg-ctc-blue-dark transition-colors">
                                    Contact Us
                                </a>
                            </div>

                            <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6">
                                <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500">Recent updates</h3>
                                <div class="mt-4 space-y-4">
                                    @forelse($recent ?? [] as $r)
                                        <a href="{{ route('news.show', $r->slug) }}" class="block group">
                                            <p class="text-sm font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors line-clamp-2">{{ $r->title }}</p>
                                            <p class="mt-1 text-xs text-gray-500">{{ optional($r->published_at ?? $r->created_at)->format('M j, Y') }}</p>
                                        </a>
                                    @empty
                                        <p class="text-sm text-gray-600">No recent posts yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
