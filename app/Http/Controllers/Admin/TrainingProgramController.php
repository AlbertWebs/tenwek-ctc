<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TrainingProgramController extends Controller
{
    public function index(): View
    {
        $programs = TrainingProgram::ordered()->get();
        return view('admin-dashboard.training.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin-dashboard.training.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        TrainingProgram::create($validated);
        return redirect()->route('admin-dashboard.training.index')->with('success', 'Program created.');
    }

    public function edit(TrainingProgram $training): View
    {
        return view('admin-dashboard.training.edit', ['program' => $training]);
    }

    public function update(Request $request, TrainingProgram $training): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        $training->update($validated);
        return redirect()->route('admin-dashboard.training.index')->with('success', 'Program updated.');
    }

    public function destroy(TrainingProgram $training): RedirectResponse
    {
        $training->delete();
        return redirect()->route('admin-dashboard.training.index')->with('success', 'Program deleted.');
    }
}
