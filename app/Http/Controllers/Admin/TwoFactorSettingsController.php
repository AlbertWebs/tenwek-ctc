<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TwoFactorSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin-dashboard.security.two-factor', [
            'twoFactorEnabled' => (bool) SiteSetting::getValue('security.2fa.enabled', false),
            'twoFactorEmailEnabled' => (bool) SiteSetting::getValue('security.2fa.email_enabled', false),
            'twoFactorSmsEnabled' => (bool) SiteSetting::getValue('security.2fa.sms_enabled', false),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'enabled' => ['nullable', 'boolean'],
            'email_enabled' => ['nullable', 'boolean'],
            'sms_enabled' => ['nullable', 'boolean'],
        ]);

        $enabled = (bool) ($data['enabled'] ?? false);
        $emailEnabled = (bool) ($data['email_enabled'] ?? false);
        $smsEnabled = (bool) ($data['sms_enabled'] ?? false);

        // Safety: if 2FA is enabled, require at least one delivery channel.
        if ($enabled && ! $emailEnabled && ! $smsEnabled) {
            return redirect()
                ->route('admin-dashboard.security.two-factor.edit')
                ->with('error', 'Enable at least one delivery method (Email or SMS) if Two-factor is turned on.');
        }

        SiteSetting::setValue('security.2fa.enabled', $enabled ? '1' : null);
        SiteSetting::setValue('security.2fa.email_enabled', $emailEnabled ? '1' : null);
        SiteSetting::setValue('security.2fa.sms_enabled', $smsEnabled ? '1' : null);

        return redirect()
            ->route('admin-dashboard.security.two-factor.edit')
            ->with('success', 'Two-factor settings updated.');
    }
}

