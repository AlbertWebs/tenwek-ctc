<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        $members = TeamMember::ordered()->get();
        return view('admin-dashboard.team-members.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin-dashboard.team-members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:20000',
            'photo' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }
        TeamMember::create($validated);
        return redirect()->route('admin-dashboard.team-members.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team_member): View
    {
        return view('admin-dashboard.team-members.edit', ['member' => $team_member]);
    }

    public function update(Request $request, TeamMember $team_member): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:20000',
            'photo' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = $team_member->slug ?: (Str::slug($validated['name']) . '-' . $team_member->id);
        }
        $validated['bio'] = TrixHtmlSanitizer::sanitize($validated['bio'] ?? '');
        $team_member->update($validated);
        return redirect()->route('admin-dashboard.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team_member): RedirectResponse
    {
        $team_member->delete();
        return redirect()->route('admin-dashboard.team-members.index')->with('success', 'Team member deleted.');
    }
}
