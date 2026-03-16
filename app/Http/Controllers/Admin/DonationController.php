<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Donation::query()->orderByDesc('donated_at')->orderByDesc('created_at');
        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($qry) use ($q) {
                $qry->where('donor_name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('campaign', 'like', "%{$q}%");
            });
        }
        $donations = $query->paginate(15)->withQueryString();
        return view('admin-dashboard.donations.index', compact('donations'));
    }

    public function create(): View
    {
        return view('admin-dashboard.donations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'amount' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'campaign' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:100',
            'donated_at' => 'nullable|date',
            'notes' => 'nullable|string|max:2000',
        ]);
        $validated['donated_at'] = $request->input('donated_at') ? now()->parse($request->input('donated_at')) : now();
        Donation::create($validated);
        return redirect()->route('admin-dashboard.donations.index')->with('success', 'Donation recorded.');
    }

    public function edit(Donation $donation): View
    {
        return view('admin-dashboard.donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation): RedirectResponse
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'amount' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'campaign' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:100',
            'donated_at' => 'nullable|date',
            'notes' => 'nullable|string|max:2000',
        ]);
        $donation->update($validated);
        return redirect()->route('admin-dashboard.donations.index')->with('success', 'Donation updated.');
    }

    public function destroy(Donation $donation): RedirectResponse
    {
        $donation->delete();
        return redirect()->route('admin-dashboard.donations.index')->with('success', 'Donation deleted.');
    }
}
