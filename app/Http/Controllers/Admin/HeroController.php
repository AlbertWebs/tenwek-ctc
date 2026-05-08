<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\SiteSetting;
use App\Support\PublicAssetUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        $mode = SiteSetting::getValue('hero.mode', 'video');
        $videoUrl = SiteSetting::getValue('hero.video_url', config('ctc.hero_video'));
        $servicesImagePath = SiteSetting::getValue('home.services_image_path');
        $servicesImageUrl = $this->publicUrl($servicesImagePath);

        $slides = HeroSlide::query()->ordered()->get();

        return view('admin-dashboard.hero.edit', compact('mode', 'videoUrl', 'slides', 'servicesImageUrl'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mode' => ['required', 'in:video,carousel'],
            'video_url' => ['nullable', 'string', 'max:2048'],
        ]);

        SiteSetting::setValue('hero.mode', $data['mode']);
        SiteSetting::setValue('hero.video_url', $data['video_url'] ?: null);

        return redirect()
            ->route('admin-dashboard.hero.edit')
            ->with('success', 'Hero settings updated.');
    }

    public function updateServicesImage(Request $request)
    {
        $request->validate([
            'services_image' => ['required', 'image', 'max:5120'],
        ]);

        $old = SiteSetting::getValue('home.services_image_path');
        if ($old && !str_starts_with($old, 'http')) {
            Storage::disk('public')->delete($old);
        }

        $path = $request->file('services_image')->store('homepage', 'public');
        SiteSetting::setValue('home.services_image_path', $path);

        return redirect()
            ->route('admin-dashboard.hero.edit')
            ->with('success', 'Services image updated.');
    }

    public function storeSlide(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->store('hero-slides', 'public');

        HeroSlide::query()->create([
            'image_path' => $path,
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'cta_label' => $data['cta_label'] ?? null,
            'cta_url' => $data['cta_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_visible' => (bool) ($data['is_visible'] ?? true),
        ]);

        return redirect()
            ->route('admin-dashboard.hero.edit')
            ->with('success', 'Slide added.');
    }

    public function updateSlide(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($heroSlide->image_path && !str_starts_with($heroSlide->image_path, 'http')) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }
            $heroSlide->image_path = $request->file('image')->store('hero-slides', 'public');
        }

        $heroSlide->fill([
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'cta_label' => $data['cta_label'] ?? null,
            'cta_url' => $data['cta_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_visible' => (bool) ($data['is_visible'] ?? false),
        ]);

        $heroSlide->save();

        return redirect()
            ->route('admin-dashboard.hero.edit')
            ->with('success', 'Slide updated.');
    }

    public function destroySlide(HeroSlide $heroSlide)
    {
        if ($heroSlide->image_path && !str_starts_with($heroSlide->image_path, 'http')) {
            Storage::disk('public')->delete($heroSlide->image_path);
        }

        $heroSlide->delete();

        return redirect()
            ->route('admin-dashboard.hero.edit')
            ->with('success', 'Slide deleted.');
    }

    private function publicUrl(?string $path): ?string
    {
        return PublicAssetUrl::toUrl($path);
    }
}

