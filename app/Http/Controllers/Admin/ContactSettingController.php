<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contact = ContactSetting::current();

        return view('admin-dashboard.contact-settings.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactSetting::current();

        $data = $request->validate([
            'address' => 'nullable|string|max:5000',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'emergency_phone' => 'nullable|string|max:255',
            'appointments_phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string|max:5000',
        ]);

        $contact->fill($data)->save();

        return redirect()
            ->route('admin-dashboard.contact-settings.edit')
            ->with('success', 'Contact details updated.');
    }
}

