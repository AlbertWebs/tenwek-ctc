@extends('admin-dashboard.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Home')

@section('content')
    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-6 mb-8">
        <x-admin-dashboard.stat-card label="Total Patients" :value="number_format($stats['total_patients'])" :href="route('admin-dashboard.bookings.index')" icon="users" color="teal" />
        <x-admin-dashboard.stat-card label="Surgeries Performed" :value="number_format($stats['surgeries_performed'])" icon="chart" color="coral" />
        <x-admin-dashboard.stat-card label="Doctors / Specialists" :value="number_format($stats['doctors_specialists'])" :href="route('admin-dashboard.team-members.index')" icon="user-group" color="teal" />
        <x-admin-dashboard.stat-card label="Active Bookings" :value="number_format($stats['active_bookings'])" :href="route('admin-dashboard.bookings.index')" icon="calendar" color="gold" />
        <x-admin-dashboard.stat-card label="Donations Received" :value="number_format($stats['donations_received']) . ' (' . number_format($stats['donations_amount'], 0) . ' KES)'" :href="route('admin-dashboard.donations.index')" icon="currency-dollar" color="coral" />
    </div>

    {{-- Quick links --}}
    <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold text-admin-dark mb-4">Quick links</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin-dashboard.team-members.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">Add team member</a>
            <a href="{{ route('admin-dashboard.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-admin-coral text-white text-sm font-medium hover:bg-admin-coral-dark transition-colors">Add service</a>
            <a href="{{ route('admin-dashboard.news.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-admin-gold text-admin-dark text-sm font-medium hover:bg-admin-gold-dark transition-colors">Add article</a>
            <a href="{{ route('admin-dashboard.bookings.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-admin-teal text-admin-teal text-sm font-medium hover:bg-admin-teal/10 transition-colors">View bookings</a>
            <a href="{{ route('admin-dashboard.enquiries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-admin-coral text-admin-coral text-sm font-medium hover:bg-admin-coral/10 transition-colors">View enquiries</a>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h3 class="text-sm font-semibold text-admin-dark mb-4">Monthly surgeries (demo)</h3>
            <div class="space-y-3">
                @php $maxS = collect($monthlySurgeries)->max('value') ?: 1; @endphp
                @foreach($monthlySurgeries as $row)
                    <div>
                        <div class="flex justify-between text-xs text-admin-muted mb-0.5">
                            <span>{{ $row['month'] }}</span>
                            <span>{{ $row['value'] }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-admin-bg overflow-hidden">
                            <div class="h-full rounded-full bg-admin-teal transition-all" style="width: {{ ($row['value'] / $maxS) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h3 class="text-sm font-semibold text-admin-dark mb-4">Donations by month</h3>
            <div class="space-y-3">
                @php $maxD = max(1, collect($monthlyDonations)->max('value')); @endphp
                @foreach($monthlyDonations as $row)
                    <div>
                        <div class="flex justify-between text-xs text-admin-muted mb-0.5">
                            <span>{{ $row['month'] }}</span>
                            <span>{{ number_format($row['value'], 0) }} KES</span>
                        </div>
                        <div class="h-2 rounded-full bg-admin-bg overflow-hidden">
                            <div class="h-full rounded-full bg-admin-coral transition-all" style="width: {{ ($row['value'] / $maxD) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h3 class="text-sm font-semibold text-admin-dark mb-4">Bookings by month</h3>
            <div class="space-y-3">
                @php $maxB = max(1, collect($monthlyBookings)->max('value')); @endphp
                @foreach($monthlyBookings as $row)
                    <div>
                        <div class="flex justify-between text-xs text-admin-muted mb-0.5">
                            <span>{{ $row['month'] }}</span>
                            <span>{{ $row['value'] }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-admin-bg overflow-hidden">
                            <div class="h-full rounded-full bg-admin-gold transition-all" style="width: {{ ($row['value'] / $maxB) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
