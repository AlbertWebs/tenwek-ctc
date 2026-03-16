<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchPublication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResearchPublicationController extends Controller
{
    public function index(): View
    {
        $items = ResearchPublication::ordered()->paginate(15);
        return view('admin-dashboard.research.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin-dashboard.research.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string|max:500',
            'journal' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'url' => 'nullable|url|max:500',
            'abstract' => 'nullable|string|max:5000',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        ResearchPublication::create($validated);
        return redirect()->route('admin-dashboard.research.index')->with('success', 'Publication added.');
    }

    public function edit(ResearchPublication $research_publication): View
    {
        return view('admin-dashboard.research.edit', ['item' => $research_publication]);
    }

    public function update(Request $request, ResearchPublication $research_publication): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string|max:500',
            'journal' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'url' => 'nullable|url|max:500',
            'abstract' => 'nullable|string|max:5000',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $research_publication->update($validated);
        return redirect()->route('admin-dashboard.research.index')->with('success', 'Publication updated.');
    }

    public function destroy(ResearchPublication $research_publication): RedirectResponse
    {
        $research_publication->delete();
        return redirect()->route('admin-dashboard.research.index')->with('success', 'Publication deleted.');
    }
}
