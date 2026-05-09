<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStory;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImpactStoryController extends Controller
{
    public function index(): View
    {
        $stories = ImpactStory::ordered()->get();
        return view('admin-dashboard.impact.index', compact('stories'));
    }

    public function create(): View
    {
        return view('admin-dashboard.impact.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'nullable|string|max:20000',
            'image' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:5120',
            'media_url' => 'nullable|string|max:2048',
            'story_date' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['story'] = TrixHtmlSanitizer::sanitize($validated['story'] ?? '');

        $story = ImpactStory::query()->create(collect($validated)->except('featured_image')->all());

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('impact', 'public');
            $story->update(['image_path' => $path]);
        }

        if ($story->is_featured) {
            ImpactStory::query()->where('id', '!=', $story->id)->update(['is_featured' => false]);
        }

        return redirect()->route('admin-dashboard.impact.index')->with('success', 'Story created.');
    }

    public function edit(ImpactStory $impact_story): View
    {
        return view('admin-dashboard.impact.edit', ['story' => $impact_story]);
    }

    public function update(Request $request, ImpactStory $impact_story): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'nullable|string|max:20000',
            'image' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:5120',
            'media_url' => 'nullable|string|max:2048',
            'story_date' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['story'] = TrixHtmlSanitizer::sanitize($validated['story'] ?? '');
        $impact_story->update(collect($validated)->except('featured_image')->all());

        if ($request->hasFile('featured_image')) {
            if ($impact_story->image_path && !str_starts_with($impact_story->image_path, 'http')) {
                Storage::disk('public')->delete($impact_story->image_path);
            }
            $path = $request->file('featured_image')->store('impact', 'public');
            $impact_story->update(['image_path' => $path]);
        }

        if ($impact_story->is_featured) {
            ImpactStory::query()->where('id', '!=', $impact_story->id)->update(['is_featured' => false]);
        }

        return redirect()->route('admin-dashboard.impact.index')->with('success', 'Story updated.');
    }

    public function destroy(ImpactStory $impact_story): RedirectResponse
    {
        $impact_story->delete();
        return redirect()->route('admin-dashboard.impact.index')->with('success', 'Story deleted.');
    }
}
