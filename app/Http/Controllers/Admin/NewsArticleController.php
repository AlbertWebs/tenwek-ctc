<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsArticleController extends Controller
{
    public function index(): View
    {
        $articles = NewsArticle::latest('published_at')->latest()->paginate(15);
        return view('admin-dashboard.news.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin-dashboard.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|in:'.implode(',', [NewsArticle::TYPE_NEWS, NewsArticle::TYPE_EVENT, NewsArticle::TYPE_ANNOUNCEMENT]),
            'excerpt' => 'nullable|string|max:1000',
            'body' => 'nullable|string|max:50000',
            'featured_image' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published');
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        NewsArticle::create($validated);
        return redirect()->route('admin-dashboard.news.index')->with('success', 'Article created.');
    }

    public function edit(NewsArticle $news): View
    {
        return view('admin-dashboard.news.edit', ['article' => $news]);
    }

    public function update(Request $request, NewsArticle $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|in:'.implode(',', [NewsArticle::TYPE_NEWS, NewsArticle::TYPE_EVENT, NewsArticle::TYPE_ANNOUNCEMENT]),
            'excerpt' => 'nullable|string|max:1000',
            'body' => 'nullable|string|max:50000',
            'featured_image' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published');
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $news->update($validated);
        return redirect()->route('admin-dashboard.news.index')->with('success', 'Article updated.');
    }

    public function destroy(NewsArticle $news): RedirectResponse
    {
        $news->delete();
        return redirect()->route('admin-dashboard.news.index')->with('success', 'Article deleted.');
    }
}
