<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategoryPage;
use App\Support\PublicAssetUrl;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceCategoryPageController extends Controller
{
    public function index(): View
    {
        $pages = ServiceCategoryPage::query()
            ->get()
            ->sortBy(fn (ServiceCategoryPage $p) => match ($p->url_segment) {
                'cardiac-surgery' => 0,
                'thoracic-surgery' => 1,
                'diagnostics' => 2,
                default => 99,
            })
            ->values();

        return view('admin-dashboard.service-category-pages.index', compact('pages'));
    }

    public function edit(ServiceCategoryPage $serviceCategoryPage): View
    {
        return view('admin-dashboard.service-category-pages.edit', [
            'page' => $serviceCategoryPage,
            'featured_image_url' => PublicAssetUrl::toUrl($serviceCategoryPage->featured_image_path),
        ]);
    }

    public function update(Request $request, ServiceCategoryPage $serviceCategoryPage): RedirectResponse
    {
        $validated = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['required', 'string', 'max:320'],
            'intro_kicker' => ['nullable', 'string', 'max:80'],
            'intro_heading' => ['required', 'string', 'max:255'],
            'intro_subheading' => ['nullable', 'string', 'max:500'],
            'body_html' => ['required', 'string', 'max:120000'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'remove_featured_image' => ['sometimes', 'boolean'],
        ]);

        $serviceCategoryPage->fill([
            'meta_title' => $validated['meta_title'] ?: null,
            'meta_description' => $validated['meta_description'],
            'intro_kicker' => $validated['intro_kicker'] ?: null,
            'intro_heading' => $validated['intro_heading'],
            'intro_subheading' => $validated['intro_subheading'] ?: null,
            'body_html' => TrixHtmlSanitizer::sanitize($validated['body_html']),
        ]);

        if ($request->hasFile('featured_image')) {
            $this->storeFeaturedImage($request, $serviceCategoryPage);
        } elseif ($request->boolean('remove_featured_image')) {
            $this->deleteFeaturedImageFile($serviceCategoryPage);
            $serviceCategoryPage->featured_image_path = null;
        }

        $serviceCategoryPage->save();

        return redirect()
            ->route('admin-dashboard.service-category-pages.edit', $serviceCategoryPage)
            ->with('success', 'Service area page updated.');
    }

    private function storeFeaturedImage(Request $request, ServiceCategoryPage $page): void
    {
        $this->deleteFeaturedImageFile($page);

        $path = $request->file('featured_image')->store('service-categories', 'public');
        $page->featured_image_path = $path;
    }

    private function deleteFeaturedImageFile(ServiceCategoryPage $page): void
    {
        $old = $page->featured_image_path;
        if ($old && ! str_starts_with($old, 'http')) {
            Storage::disk('public')->delete($old);
        }
    }
}
