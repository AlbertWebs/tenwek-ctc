<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\PublicAssetUrl;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutPurposeController extends Controller
{
    public function edit(): View
    {
        return view('admin-dashboard.about.purpose', [
            'kicker' => SiteSetting::getValue('about.purpose.kicker', 'Purpose'),
            'heading' => SiteSetting::getValue('about.purpose.heading', 'Mission & Vision'),

            'mission_kicker' => SiteSetting::getValue('about.purpose.mission.kicker', 'Mission'),
            'mission_title' => SiteSetting::getValue('about.purpose.mission.title', 'Excellent, compassionate care'),
            'mission_body' => SiteSetting::getValue('about.purpose.mission.body', 'To provide excellent, compassionate cardiothoracic care to all who need it, and to train the next generation of surgeons and healthcare workers for Africa.'),

            'vision_kicker' => SiteSetting::getValue('about.purpose.vision.kicker', 'Vision'),
            'vision_title' => SiteSetting::getValue('about.purpose.vision.title', 'Access for every patient'),
            'vision_body' => SiteSetting::getValue('about.purpose.vision.body', 'A region where every person has access to life‑saving heart and chest surgery, delivered by well‑trained local teams.'),

            'right_kicker' => SiteSetting::getValue('about.purpose.right.kicker', 'How we work'),
            'right_title' => SiteSetting::getValue('about.purpose.right.title', 'What patients can expect'),
            'right_body' => SiteSetting::getValue('about.purpose.right.body', 'Clear communication, safety-first protocols, and coordinated care from referral through recovery.'),
            'right_image_url' => PublicAssetUrl::toUrl(SiteSetting::getValue('about.purpose.right.image_path')),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kicker' => ['required', 'string', 'max:80'],
            'heading' => ['required', 'string', 'max:255'],

            'mission_kicker' => ['required', 'string', 'max:80'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_body' => ['required', 'string', 'max:20000'],

            'vision_kicker' => ['required', 'string', 'max:80'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision_body' => ['required', 'string', 'max:20000'],

            'right_kicker' => ['required', 'string', 'max:80'],
            'right_title' => ['required', 'string', 'max:255'],
            'right_body' => ['required', 'string', 'max:20000'],
            'right_image' => ['nullable', 'image', 'max:5120'],
        ]);

        SiteSetting::setValue('about.purpose.kicker', $validated['kicker']);
        SiteSetting::setValue('about.purpose.heading', $validated['heading']);

        SiteSetting::setValue('about.purpose.mission.kicker', $validated['mission_kicker']);
        SiteSetting::setValue('about.purpose.mission.title', $validated['mission_title']);
        SiteSetting::setValue('about.purpose.mission.body', TrixHtmlSanitizer::sanitize($validated['mission_body']));

        SiteSetting::setValue('about.purpose.vision.kicker', $validated['vision_kicker']);
        SiteSetting::setValue('about.purpose.vision.title', $validated['vision_title']);
        SiteSetting::setValue('about.purpose.vision.body', TrixHtmlSanitizer::sanitize($validated['vision_body']));

        SiteSetting::setValue('about.purpose.right.kicker', $validated['right_kicker']);
        SiteSetting::setValue('about.purpose.right.title', $validated['right_title']);
        SiteSetting::setValue('about.purpose.right.body', TrixHtmlSanitizer::sanitize($validated['right_body']));

        $this->maybeStoreImage($request, 'right_image', 'about.purpose.right.image_path');

        return redirect()
            ->route('admin-dashboard.about-purpose.edit')
            ->with('success', 'Purpose section updated.');
    }

    private function maybeStoreImage(Request $request, string $fileKey, string $settingKey): void
    {
        if (! $request->hasFile($fileKey)) {
            return;
        }

        $old = SiteSetting::getValue($settingKey);
        if ($old && ! str_starts_with($old, 'http')) {
            Storage::disk('public')->delete($old);
        }

        $path = $request->file($fileKey)->store('about', 'public');
        SiteSetting::setValue($settingKey, $path);
    }
}
