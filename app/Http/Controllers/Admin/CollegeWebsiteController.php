<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollegeWebsiteController extends Controller
{
    public function edit(): View
    {
        return view('admin-dashboard.settings.college-website', [
            'url' => old('url', SiteSetting::getValue('external.college_website_url') ?? ''),
            'label' => old('label', SiteSetting::getValue('external.college_website_label') ?? ''),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'url' => ['nullable', 'url', 'max:2048'],
            'label' => ['nullable', 'string', 'max:120'],
        ]);

        $url = isset($data['url']) && is_string($data['url']) && trim($data['url']) !== '' ? trim($data['url']) : null;
        $label = isset($data['label']) && is_string($data['label']) && trim($data['label']) !== '' ? trim($data['label']) : null;

        SiteSetting::setValue('external.college_website_url', $url);
        SiteSetting::setValue('external.college_website_label', $label);

        return redirect()
            ->route('admin-dashboard.settings.college-website.edit')
            ->with('success', 'College website link updated.');
    }
}
