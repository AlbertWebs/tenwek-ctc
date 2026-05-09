<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoreValueController extends Controller
{
    public function index(): View
    {
        $values = CoreValue::ordered()->get();

        return view('admin-dashboard.core-values.index', compact('values'));
    }

    public function create(): View
    {
        return view('admin-dashboard.core-values.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:20000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['description'] = TrixHtmlSanitizer::sanitize($validated['description'] ?? '');

        CoreValue::create($validated);

        return redirect()
            ->route('admin-dashboard.core-values.index')
            ->with('success', 'Core value created.');
    }

    public function edit(CoreValue $core_value): View
    {
        return view('admin-dashboard.core-values.edit', ['value' => $core_value]);
    }

    public function update(Request $request, CoreValue $core_value): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:20000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['description'] = TrixHtmlSanitizer::sanitize($validated['description'] ?? '');

        $core_value->update($validated);

        return redirect()
            ->route('admin-dashboard.core-values.index')
            ->with('success', 'Core value updated.');
    }

    public function destroy(CoreValue $core_value): RedirectResponse
    {
        $core_value->delete();

        return redirect()
            ->route('admin-dashboard.core-values.index')
            ->with('success', 'Core value deleted.');
    }
}
