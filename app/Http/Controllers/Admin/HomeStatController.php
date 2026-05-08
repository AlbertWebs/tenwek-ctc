<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeStat;
use Illuminate\Http\Request;

class HomeStatController extends Controller
{
    public function index()
    {
        $stats = HomeStat::query()->ordered()->get();
        return view('admin-dashboard.home-stats.index', compact('stats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'value' => ['required', 'string', 'max:50'],
            'label' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        HomeStat::query()->create([
            'value' => $data['value'],
            'label' => $data['label'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_visible' => (bool) ($data['is_visible'] ?? true),
        ]);

        return redirect()
            ->route('admin-dashboard.home-stats.index')
            ->with('success', 'Stat added.');
    }

    public function update(Request $request, HomeStat $homeStat)
    {
        $data = $request->validate([
            'value' => ['required', 'string', 'max:50'],
            'label' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        $homeStat->update([
            'value' => $data['value'],
            'label' => $data['label'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_visible' => (bool) ($data['is_visible'] ?? false),
        ]);

        return redirect()
            ->route('admin-dashboard.home-stats.index')
            ->with('success', 'Stat updated.');
    }

    public function destroy(HomeStat $homeStat)
    {
        $homeStat->delete();

        return redirect()
            ->route('admin-dashboard.home-stats.index')
            ->with('success', 'Stat deleted.');
    }
}

