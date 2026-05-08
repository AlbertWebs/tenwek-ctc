<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryMilestone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryMilestoneController extends Controller
{
    public function index(): View
    {
        $milestones = HistoryMilestone::query()->ordered()->get();
        return view('admin-dashboard.history-milestones.index', compact('milestones'));
    }

    public function create(): View
    {
        return view('admin-dashboard.history-milestones.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'nullable|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:8000',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        HistoryMilestone::query()->create($validated);

        return redirect()->route('admin-dashboard.history-milestones.index')->with('success', 'Milestone created.');
    }

    public function edit(HistoryMilestone $history_milestone): View
    {
        return view('admin-dashboard.history-milestones.edit', ['milestone' => $history_milestone]);
    }

    public function update(Request $request, HistoryMilestone $history_milestone): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'nullable|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:8000',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        $history_milestone->update($validated);

        return redirect()->route('admin-dashboard.history-milestones.index')->with('success', 'Milestone updated.');
    }

    public function destroy(HistoryMilestone $history_milestone): RedirectResponse
    {
        $history_milestone->delete();
        return redirect()->route('admin-dashboard.history-milestones.index')->with('success', 'Milestone deleted.');
    }
}

