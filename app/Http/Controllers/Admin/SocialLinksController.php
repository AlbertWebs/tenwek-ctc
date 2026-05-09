<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialLinksController extends Controller
{
    public function edit(): View
    {
        return view('admin-dashboard.settings.social-links', [
            'facebook' => SiteSetting::getValue('social.facebook'),
            'x' => SiteSetting::getValue('social.x'),
            'instagram' => SiteSetting::getValue('social.instagram'),
            'youtube' => SiteSetting::getValue('social.youtube'),
            'linkedin' => SiteSetting::getValue('social.linkedin'),
            'tiktok' => SiteSetting::getValue('social.tiktok'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'facebook' => ['nullable', 'url', 'max:2048'],
            'x' => ['nullable', 'url', 'max:2048'],
            'instagram' => ['nullable', 'url', 'max:2048'],
            'youtube' => ['nullable', 'url', 'max:2048'],
            'linkedin' => ['nullable', 'url', 'max:2048'],
            'tiktok' => ['nullable', 'url', 'max:2048'],
        ]);

        SiteSetting::setValue('social.facebook', $data['facebook'] ?? null);
        SiteSetting::setValue('social.x', $data['x'] ?? null);
        SiteSetting::setValue('social.instagram', $data['instagram'] ?? null);
        SiteSetting::setValue('social.youtube', $data['youtube'] ?? null);
        SiteSetting::setValue('social.linkedin', $data['linkedin'] ?? null);
        SiteSetting::setValue('social.tiktok', $data['tiktok'] ?? null);

        return redirect()
            ->route('admin-dashboard.settings.social-links.edit')
            ->with('success', 'Social links updated.');
    }
}

