@extends('admin-dashboard.layouts.app')

@section('title', 'News')
@section('header', 'News & events')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3 sm:px-6">
            <p class="text-sm text-gray-600">{{ $articles->total() }} article(s)</p>
            <a href="{{ route('admin-dashboard.news.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                Add article
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table min-w-full">
                <thead>
                    <tr>
                        <th class="text-left">Title</th>
                        <th class="text-left">Type</th>
                        <th class="text-left">Published</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($articles as $article)
                        <tr>
                            <td class="text-sm font-medium text-gray-900">{{ $article->title }}</td>
                            <td class="text-sm text-gray-600">{{ $article->type }}</td>
                            <td class="text-sm">
                                @if($article->is_published)<span class="text-green-600">Yes</span>@else<span class="text-gray-400">No</span>@endif
                                @if($article->published_at) <span class="text-gray-400">({{ $article->published_at->format('M j, Y') }})</span>@endif
                            </td>
                            <td class="text-right text-sm">
                                <a href="{{ route('admin-dashboard.news.edit', $article) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin-dashboard.news.destroy', $article) }}" method="post" class="inline" onsubmit="return confirm('Delete this article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-10">No articles yet. <a href="{{ route('admin-dashboard.news.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
