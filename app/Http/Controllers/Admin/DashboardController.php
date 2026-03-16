<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Donation;
use App\Models\NewsArticle;
use App\Models\Service;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_patients' => Booking::count(),
            'surgeries_performed' => (int) config('ctc.demo_surgeries', 5000),
            'doctors_specialists' => TeamMember::count(),
            'active_bookings' => Booking::active()->count(),
            'donations_received' => Donation::count(),
            'donations_amount' => (float) Donation::sum('amount'),
        ];

        $monthlySurgeries = $this->monthlyChartData(6, 80, 120);
        $monthlyDonations = $this->monthlyDonationChartData();
        $monthlyBookings = $this->monthlyBookingsChartData();

        return view('admin-dashboard.dashboard', compact(
            'stats',
            'monthlySurgeries',
            'monthlyDonations',
            'monthlyBookings'
        ));
    }

    private function monthlyChartData(int $months, int $min, int $max): array
    {
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $data[] = [
                'month' => now()->subMonths($i)->format('M Y'),
                'value' => rand($min, $max),
            ];
        }
        return $data;
    }

    private function monthlyDonationChartData(): array
    {
        $donations = Donation::query()
            ->whereNotNull('donated_at')
            ->where('donated_at', '>=', now()->subMonths(5))
            ->get();

        $byMonth = $donations->groupBy(fn ($d) => $d->donated_at->format('Y-m'))->map->sum('amount');

        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->subMonths($i)->format('Y-m');
            $data[] = [
                'month' => now()->subMonths($i)->format('M Y'),
                'value' => (float) ($byMonth[$m] ?? 0),
            ];
        }
        return $data;
    }

    private function monthlyBookingsChartData(): array
    {
        $bookings = Booking::query()
            ->where('created_at', '>=', now()->subMonths(5))
            ->get();

        $byMonth = $bookings->groupBy(fn ($b) => $b->created_at->format('Y-m'))->map->count();

        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->subMonths($i)->format('Y-m');
            $data[] = [
                'month' => now()->subMonths($i)->format('M Y'),
                'value' => (int) ($byMonth[$m] ?? 0),
            ];
        }
        return $data;
    }
}
