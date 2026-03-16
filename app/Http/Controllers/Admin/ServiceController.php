<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::ordered()->get();
        return view('admin-dashboard.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin-dashboard.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|in:'.implode(',', [Service::CATEGORY_CARDIAC, Service::CATEGORY_THORACIC, Service::CATEGORY_DIAGNOSTICS]),
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        Service::create($validated);
        return redirect()->route('admin-dashboard.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin-dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|in:'.implode(',', [Service::CATEGORY_CARDIAC, Service::CATEGORY_THORACIC, Service::CATEGORY_DIAGNOSTICS]),
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        $service->update($validated);
        return redirect()->route('admin-dashboard.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        return redirect()->route('admin-dashboard.services.index')->with('success', 'Service deleted.');
    }
}
