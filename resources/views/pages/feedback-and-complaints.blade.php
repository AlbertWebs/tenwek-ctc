@extends('layouts.app')

@section('title', 'Feedback & Complaints')

@section('content')
    @include('components.page-banner', [
        'title' => 'Feedback & Complaints',
        'subtitle' => config('ctc.hospital'),
        'bannerKey' => 'feedback',
    ])

    <section class="py-16 lg:py-20 bg-ctc-grey-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid gap-10 lg:grid-cols-12 items-start">
                    {{-- Sidebar --}}
                    <aside class="lg:col-span-4">
                        <div class="flex flex-col gap-6">
                        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6 lg:p-7">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ctc-secondary">We’re listening</p>
                            <h2 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">Help us improve care and service.</h2>
                            <p class="mt-4 text-sm leading-7 text-gray-600">
                                Share feedback to help us strengthen the patient experience. If something went wrong, submit a complaint so our team can follow up.
                            </p>

                            <div class="mt-6 grid gap-4">
                                <div class="rounded-xl bg-ctc-grey-light border border-gray-200 p-4">
                                    <p class="text-xs font-semibold text-gray-900">For urgent medical needs</p>
                                    <p class="mt-1 text-xs text-gray-600">Use the emergency contact in the top bar.</p>
                                </div>
                                <div class="rounded-xl bg-ctc-grey-light border border-gray-200 p-4">
                                    <p class="text-xs font-semibold text-gray-900">What happens next?</p>
                                    <ul class="mt-2 space-y-1.5 text-xs text-gray-600">
                                        <li>We review every submission.</li>
                                        <li>We may contact you if details are needed.</li>
                                        <li>Complaints are routed to the appropriate team.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6 lg:p-7">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ctc-secondary">Contact</p>
                            <h3 class="mt-3 text-lg font-bold text-gray-900">Need to reach the team?</h3>
                            <p class="mt-2 text-sm text-gray-600">Use these contacts for non-urgent enquiries.</p>

                            <div class="mt-5 space-y-4 text-sm">
                                <div class="rounded-xl bg-ctc-grey-light border border-gray-200 p-4">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-gray-500">Phone</p>
                                    <a href="tel:{{ preg_replace('/\D+/', '', config('ctc.contact.phone')) }}" class="mt-1 block font-semibold text-gray-900 hover:text-ctc-blue transition-colors">
                                        {{ config('ctc.contact.phone') }}
                                    </a>
                                </div>

                                <div class="rounded-xl bg-ctc-grey-light border border-gray-200 p-4">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-gray-500">Email</p>
                                    <a href="mailto:{{ config('ctc.contact.email') }}" class="mt-1 block font-semibold text-gray-900 hover:text-ctc-blue transition-colors break-all">
                                        {{ config('ctc.contact.email') }}
                                    </a>
                                </div>

                                <div class="rounded-xl bg-ctc-blue-dark text-white p-4 border border-white/10">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-white/70">Emergency</p>
                                    <a href="tel:{{ preg_replace('/\D+/', '', config('ctc.contact.emergency')) }}" class="mt-1 block font-semibold text-white hover:text-ctc-secondary transition-colors">
                                        {{ config('ctc.contact.emergency') }}
                                    </a>
                                    <p class="mt-2 text-xs text-white/70">Available 24/7</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </aside>

                    {{-- Form --}}
                    <div class="lg:col-span-8">
                        @if (session('success'))
                            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-6 lg:p-10">
                            <div class="flex items-start justify-between gap-6">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Submit feedback</h3>
                                    <p class="mt-1 text-sm text-gray-600">All fields are required unless marked optional.</p>
                                </div>
                                <div class="hidden sm:flex items-center gap-2 text-xs text-gray-500">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-ctc-secondary"></span>
                                    Protected by a simple anti-spam check
                                </div>
                            </div>

                            <form action="{{ route('feedback.submit') }}" method="POST" class="mt-8 grid gap-5 sm:grid-cols-2">
                                @csrf

                                <div>
                                    <label for="type" class="block text-sm font-semibold text-gray-900">Submission Type</label>
                                    <select name="type" id="type" class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-ctc-secondary focus:ring-ctc-secondary">
                                        <option value="feedback" {{ old('type') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                        <option value="complaint" {{ old('type') === 'complaint' ? 'selected' : '' }}>Complaint</option>
                                    </select>
                                    @error('type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-900">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-ctc-secondary focus:ring-ctc-secondary" required />
                                    @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="email" class="block text-sm font-semibold text-gray-900">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-ctc-secondary focus:ring-ctc-secondary" required />
                                    @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="message" class="block text-sm font-semibold text-gray-900">Message</label>
                                    <textarea name="message" id="message" rows="6" class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-ctc-secondary focus:ring-ctc-secondary" required>{{ old('message') }}</textarea>
                                    @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="math_answer" class="block text-sm font-semibold text-gray-900">
                                        Anti-spam: what is {{ $mathA ?? 0 }} + {{ $mathB ?? 0 }}?
                                    </label>
                                    <input
                                        type="number"
                                        name="math_answer"
                                        id="math_answer"
                                        value="{{ old('math_answer') }}"
                                        inputmode="numeric"
                                        class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-ctc-secondary focus:ring-ctc-secondary"
                                        required
                                    />
                                    @error('math_answer')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="sm:col-span-2 flex flex-wrap items-center gap-3 pt-2">
                                    <button type="submit" class="inline-flex rounded-xl bg-ctc-blue px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-ctc-blue-dark">
                                        Submit
                                    </button>
                                    <p class="text-xs text-gray-500">For urgent medical needs, use the emergency contact in the top bar.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

