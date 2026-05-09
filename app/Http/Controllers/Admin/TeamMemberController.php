<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'photo' => 'nullable|image|max:5120',
            'photo_url' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }
        $validated['bio'] = TrixHtmlSanitizer::sanitize($validated['bio'] ?? '');

        $member = TeamMember::create(collect($validated)->except(['photo', 'photo_url'])->all());

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('team', 'public');
            $member->update(['photo' => $path]);
        } elseif (! empty($validated['photo_url'])) {
            $member->update(['photo' => $validated['photo_url']]);
        }

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
            'photo' => 'nullable|image|max:5120',
            'photo_url' => 'nullable|string|max:500',
            'remove_photo' => 'sometimes|boolean',
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

        $team_member->update(collect($validated)->except(['photo', 'photo_url', 'remove_photo'])->all());

        if ($request->boolean('remove_photo')) {
            if ($team_member->photo && ! str_starts_with($team_member->photo, 'http')) {
                Storage::disk('public')->delete($team_member->photo);
            }
            $team_member->update(['photo' => null]);
        } elseif ($request->hasFile('photo')) {
            if ($team_member->photo && ! str_starts_with($team_member->photo, 'http')) {
                Storage::disk('public')->delete($team_member->photo);
            }
            $path = $request->file('photo')->store('team', 'public');
            $team_member->update(['photo' => $path]);
        } elseif (! empty($validated['photo_url'])) {
            if ($team_member->photo && ! str_starts_with($team_member->photo, 'http')) {
                Storage::disk('public')->delete($team_member->photo);
            }
            $team_member->update(['photo' => $validated['photo_url']]);
        }

        return redirect()->route('admin-dashboard.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team_member): RedirectResponse
    {
        $team_member->delete();
        return redirect()->route('admin-dashboard.team-members.index')->with('success', 'Team member deleted.');
    }
}
