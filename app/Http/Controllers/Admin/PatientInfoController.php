<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientInfoBlock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientInfoController extends Controller
{
    public function index(): View
    {
        $blocks = PatientInfoBlock::ordered()->get();
        return view('admin-dashboard.patient-info.index', compact('blocks'));
    }

    public function create(): View
    {
        return view('admin-dashboard.patient-info.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'key' => 'required|string|max:100|unique:patient_info_blocks,key',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        PatientInfoBlock::create($validated);
        return redirect()->route('admin-dashboard.patient-info.index')->with('success', 'Block created.');
    }

    public function edit(PatientInfoBlock $patient_info_block): View
    {
        return view('admin-dashboard.patient-info.edit', ['block' => $patient_info_block]);
    }

    public function update(Request $request, PatientInfoBlock $patient_info_block): RedirectResponse
    {
        $validated = $request->validate([
            'key' => 'required|string|max:100|unique:patient_info_blocks,key,' . $patient_info_block->id,
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $patient_info_block->update($validated);
        return redirect()->route('admin-dashboard.patient-info.index')->with('success', 'Block updated.');
    }

    public function destroy(PatientInfoBlock $patient_info_block): RedirectResponse
    {
        $patient_info_block->delete();
        return redirect()->route('admin-dashboard.patient-info.index')->with('success', 'Block deleted.');
    }
}
