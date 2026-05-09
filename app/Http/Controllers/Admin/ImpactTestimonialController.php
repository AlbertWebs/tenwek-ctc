<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactTestimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImpactTestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = ImpactTestimonial::ordered()->get();

        return view('admin-dashboard.impact-testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin-dashboard.impact-testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quote' => 'required|string|max:5000',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        $row = ImpactTestimonial::query()->create(collect($validated)->except('photo')->all());

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('impact-testimonials', 'public');
            $row->update(['image_path' => $path]);
        }

        return redirect()->route('admin-dashboard.impact-testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(ImpactTestimonial $impact_testimonial): View
    {
        return view('admin-dashboard.impact-testimonials.edit', ['testimonial' => $impact_testimonial]);
    }

    public function update(Request $request, ImpactTestimonial $impact_testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'quote' => 'required|string|max:5000',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        $impact_testimonial->update(collect($validated)->except('photo')->all());

        if ($request->hasFile('photo')) {
            if ($impact_testimonial->image_path && ! str_starts_with($impact_testimonial->image_path, 'http')) {
                Storage::disk('public')->delete($impact_testimonial->image_path);
            }
            $path = $request->file('photo')->store('impact-testimonials', 'public');
            $impact_testimonial->update(['image_path' => $path]);
        }

        return redirect()->route('admin-dashboard.impact-testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(ImpactTestimonial $impact_testimonial): RedirectResponse
    {
        if ($impact_testimonial->image_path && ! str_starts_with($impact_testimonial->image_path, 'http')) {
            Storage::disk('public')->delete($impact_testimonial->image_path);
        }
        $impact_testimonial->delete();

        return redirect()->route('admin-dashboard.impact-testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
