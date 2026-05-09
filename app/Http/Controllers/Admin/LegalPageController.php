<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\LegalPageContent;
use App\Support\TrixHtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    private const PAGES = [
        'privacy' => [
            'label' => 'Privacy Policy',
            'setting_key' => 'legal.privacy.body',
            'public_route' => 'privacy-policy',
            'public_path' => '/privacy-policy',
        ],
        'terms' => [
            'label' => 'Terms of Service',
            'setting_key' => 'legal.terms.body',
            'public_route' => 'terms-of-service',
            'public_path' => '/terms-of-service',
        ],
    ];

    public function index(): View
    {
        $pages = [];
        foreach (self::PAGES as $slug => $meta) {
            $pages[] = array_merge(['slug' => $slug], $meta);
        }

        return view('admin-dashboard.legal-pages.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $meta = self::PAGES[$page] ?? abort(404);

        $default = $page === 'privacy'
            ? LegalPageContent::privacyHtml()
            : LegalPageContent::termsHtml();

        $body = SiteSetting::getValue($meta['setting_key'], '');
        if ($body === '') {
            $body = $default;
        }

        return view('admin-dashboard.legal-pages.edit', [
            'page' => $page,
            'meta' => $meta,
            'body' => $body,
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $meta = self::PAGES[$page] ?? abort(404);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:200000'],
        ]);

        $html = TrixHtmlSanitizer::sanitize($validated['body']);
        SiteSetting::setValue($meta['setting_key'], $html);

        return redirect()
            ->route('admin-dashboard.legal-pages.edit', $page)
            ->with('success', $meta['label'].' saved.');
    }
}
