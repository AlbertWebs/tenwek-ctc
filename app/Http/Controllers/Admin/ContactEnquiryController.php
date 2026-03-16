<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactEnquiryController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactEnquiry::query()->orderByDesc('created_at');
        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('message', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        $enquiries = $query->paginate(15)->withQueryString();
        return view('admin-dashboard.enquiries.index', compact('enquiries'));
    }

    public function show(ContactEnquiry $enquiry): View
    {
        if ($enquiry->status === ContactEnquiry::STATUS_NEW) {
            $enquiry->update(['status' => ContactEnquiry::STATUS_READ]);
        }
        return view('admin-dashboard.enquiries.show', compact('enquiry'));
    }

    public function update(Request $request, ContactEnquiry $enquiry): RedirectResponse
    {
        $request->validate(['status' => 'required|in:new,read,replied,archived']);
        $enquiry->update(['status' => $request->input('status')]);
        return redirect()->route('admin-dashboard.enquiries.show', $enquiry)->with('success', 'Status updated.');
    }

    public function destroy(ContactEnquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();
        return redirect()->route('admin-dashboard.enquiries.index')->with('success', 'Enquiry deleted.');
    }
}
