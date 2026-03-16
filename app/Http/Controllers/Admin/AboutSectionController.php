<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        AboutSection::create($validated);
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
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $about_section->update($validated);
        return redirect()->route('admin-dashboard.about.index')->with('success', 'Section updated.');
    }

    public function destroy(AboutSection $about_section): RedirectResponse
    {
        $about_section->delete();
        return redirect()->route('admin-dashboard.about.index')->with('success', 'Section deleted.');
    }
}
