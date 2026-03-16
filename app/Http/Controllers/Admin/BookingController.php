<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Booking::query()->orderByDesc('created_at');
        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($qry) use ($q) {
                $qry->where('patient_name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('phone', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        $bookings = $query->paginate(15)->withQueryString();
        return view('admin-dashboard.bookings.index', compact('bookings'));
    }

    public function create(): View
    {
        return view('admin-dashboard.bookings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'requested_date' => 'nullable|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'type' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:2000',
        ]);
        $validated['type'] = $validated['type'] ?? 'appointment';
        Booking::create($validated);
        return redirect()->route('admin-dashboard.bookings.index')->with('success', 'Booking created.');
    }

    public function edit(Booking $booking): View
    {
        return view('admin-dashboard.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'requested_date' => 'nullable|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'type' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:2000',
        ]);
        $booking->update($validated);
        return redirect()->route('admin-dashboard.bookings.index')->with('success', 'Booking updated.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();
        return redirect()->route('admin-dashboard.bookings.index')->with('success', 'Booking deleted.');
    }
}
