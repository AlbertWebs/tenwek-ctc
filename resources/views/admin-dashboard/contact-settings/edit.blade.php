@extends('admin-dashboard.layouts.app')

@section('title', 'Contact Details')
@section('header', 'Contact Details')

@section('content')
    <div class="max-w-5xl space-y-6">
        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Public contact information</h2>
            <p class="text-sm text-admin-muted mb-6">These details appear on the website’s <span class="font-medium">Contact</span> page and other contact sections.</p>

            <form method="post" action="{{ route('admin-dashboard.contact-settings.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-admin-dark">Address</label>
                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                            placeholder="Tenwek Hospital, P.O. Box 39, Bomet, Kenya"
                        >{{ old('address', $contact->address) }}</textarea>
                        @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-admin-dark">Main phone</label>
                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            value="{{ old('phone', $contact->phone) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                            placeholder="+254 (0) ..."
                        />
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-admin-dark">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $contact->email) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                            placeholder="ctc@tenwekhospital.org"
                        />
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="emergency_phone" class="block text-sm font-semibold text-admin-dark">Emergency phone</label>
                        <input
                            id="emergency_phone"
                            name="emergency_phone"
                            type="text"
                            value="{{ old('emergency_phone', $contact->emergency_phone) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                            placeholder="+254 ..."
                        />
                        @error('emergency_phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="appointments_phone" class="block text-sm font-semibold text-admin-dark">Appointments / referrals phone (optional)</label>
                        <input
                            id="appointments_phone"
                            name="appointments_phone"
                            type="text"
                            value="{{ old('appointments_phone', $contact->appointments_phone) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                        />
                        @error('appointments_phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-semibold text-admin-dark">WhatsApp (optional)</label>
                        <input
                            id="whatsapp"
                            name="whatsapp"
                            type="text"
                            value="{{ old('whatsapp', $contact->whatsapp) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                        />
                        @error('whatsapp')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="fax" class="block text-sm font-semibold text-admin-dark">Fax (optional)</label>
                        <input
                            id="fax"
                            name="fax"
                            type="text"
                            value="{{ old('fax', $contact->fax) }}"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                        />
                        @error('fax')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="map_embed_url" class="block text-sm font-semibold text-admin-dark">Google Maps embed URL</label>
                        <p class="mt-1 text-xs text-admin-muted">Paste the value from the iframe’s <code class="text-[11px]">src</code> attribute.</p>
                        <textarea
                            id="map_embed_url"
                            name="map_embed_url"
                            rows="3"
                            class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"
                            placeholder="https://www.google.com/maps/embed?pb=..."
                        >{{ old('map_embed_url', $contact->map_embed_url) }}</textarea>
                        @error('map_embed_url')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Save contact details
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

