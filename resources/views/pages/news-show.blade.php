@extends('layouts.app')

@section('title', $article->title)

@section('content')
    @include('components.page-banner', [
        'title' => $article->title,
        'subtitle' => 'News & Media',
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12 items-start">
                <article class="lg:col-span-8">
                    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
                        <div class="aspect-video bg-ctc-grey-light">
                            <img
                                src="{{ $article->featured_image ?: 'https://images.unsplash.com/photo-1580281658629-99bb1fd55b0a?auto=format&fit=crop&w=1600&q=60' }}"
                                alt="{{ $article->title }}"
                                class="h-full w-full object-cover"
                                loading="eager"
                                fetchpriority="high"
                            >
                        </div>

                        <div class="p-6 lg:p-8">
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                <span class="inline-flex items-center rounded-full bg-ctc-grey-light px-3 py-1 text-xs font-semibold uppercase tracking-wide text-ctc-blue">
                                    {{ $article->type }}
                                </span>
                                <span aria-hidden="true">•</span>
                                <time datetime="{{ optional($article->published_at)->toIso8601String() }}">
                                    {{ optional($article->published_at ?? $article->created_at)->format('F j, Y') }}
                                </time>
                            </div>

                            @if($article->excerpt)
                                <p class="mt-5 text-[1.05rem] leading-8 text-gray-700">
                                    {{ $article->excerpt }}
                                </p>
                            @endif

                            <div class="mt-8 prose prose-slate max-w-none prose-headings:font-headline prose-headings:text-ctc-blue prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-ctc-secondary prose-strong:text-ctc-blue">
                                {!! $article->body ? $article->body : '<p>Full story content will be published here.</p>' !!}
                            </div>
                        </div>
                    </div>
                </article>

                <aside class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
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
                                @forelse($recent as $r)
                                    <a href="{{ route('news.show', $r->slug) }}" class="block group">
                                        <p class="text-sm font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors line-clamp-2">{{ $r->title }}</p>
                                        <p class="mt-1 text-xs text-gray-500">{{ optional($r->published_at ?? $r->created_at)->format('M j, Y') }}</p>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-600">No recent posts yet.</p>
                                @endforelse
                            </div>
                            <a href="{{ route('news') }}" class="mt-5 inline-flex items-center text-sm font-semibold text-ctc-secondary hover:underline">
                                View all news →
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

