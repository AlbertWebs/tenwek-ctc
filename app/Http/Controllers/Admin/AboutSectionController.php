<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutSectionController extends Controller
{
    public function index(): View
    {
        $sections = AboutSection::ordered()->get();
        return view('admin-dashboard.about.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin-dashboard.about.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'key' => 'required|string|max:100|unique:about_sections,key',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:50000',
            'featured_image' => 'nullable|image|max:5120',
            'media_url' => 'nullable|string|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['content'] = TrixHtmlSanitizer::sanitize($validated['content'] ?? '');

        $section = AboutSection::create(collect($validated)->except('featured_image')->all());

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('about', 'public');
            $section->update(['featured_image_path' => $path]);
        }
        return redirect()->route('admin-dashboard.about.index')->with('success', 'Section created.');
    }

    public function edit(AboutSection $about_section): View
    {
        return view('admin-dashboard.about.edit', ['section' => $about_section]);
    }

    public function update(Request $request, AboutSection $about_section): RedirectResponse
    {
        $validated = $request->validate([
            'key' => 'required|string|max:100|unique:about_sections,key,' . $about_section->id,
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:50000',
            'featured_image' => 'nullable|image|max:5120',
            'media_url' => 'nullable|string|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['content'] = TrixHtmlSanitizer::sanitize($validated['content'] ?? '');
        $about_section->update(collect($validated)->except('featured_image')->all());

        if ($request->hasFile('featured_image')) {
            if ($about_section->featured_image_path && !str_starts_with($about_section->featured_image_path, 'http')) {
                Storage::disk('public')->delete($about_section->featured_image_path);
            }
            $path = $request->file('featured_image')->store('about', 'public');
            $about_section->update(['featured_image_path' => $path]);
        }
        return redirect()->route('admin-dashboard.about.index')->with('success', 'Section updated.');
    }

    public function destroy(AboutSection $about_section): RedirectResponse
    {
        $about_section->delete();
        return redirect()->route('admin-dashboard.about.index')->with('success', 'Section deleted.');
    }
}
