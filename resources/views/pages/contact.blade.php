@extends('layouts.app')

@section('title', 'Contact Us')

@php
    $contact = $contact ?? null;
    $address = $contact?->address ?: config('ctc.contact.address');
    $phone = $contact?->phone ?: config('ctc.contact.phone');
    $email = $contact?->email ?: config('ctc.contact.email');
    $emergency = $contact?->emergency_phone ?: config('ctc.contact.emergency');
    $appointmentsPhone = $contact?->appointments_phone;
    $whatsapp = $contact?->whatsapp;
    $fax = $contact?->fax;

    $mapEmbedUrl = $contact?->map_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255328.57190435287!2d35.412123193156454!3d-0.713531316170022!2m3!1f0!2f0!3f0!3m2!1i1024!1i768!4f13.1!3m3!1m2!1s0x182b99e773d0b419%3A0x9a894bffe3e322cd!2sAGC%20Tenwek%20Cardiothoracic%20Centre!5e0!3m2!1sen!2ske!4v1778251323615!5m2!1sen!2ske';
@endphp

@section('content')
    @include('components.page-banner', [
        'title' => 'Contact Us',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                    <div class="lg:col-span-5">
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 sm:p-8">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Send a message</h2>
                                    <p class="mt-1 text-sm text-gray-600">We’ll respond as soon as possible. For urgent care, call the emergency line.</p>
                                </div>
                                <div class="hidden sm:flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-900">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)]"></span>
                                    Emergency
                                </div>
                            </div>

                            @if(session('success'))
                                <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mt-5 rounded-xl border border-amber-200 bg-amber-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-900">Emergency contact</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}" class="mt-1 inline-flex items-center text-base font-semibold text-gray-900 hover:underline">
                                    {{ $emergency }}
                                </a>
                            </div>

                            <form action="{{ route('contact.submit') }}" method="post" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                   placeholder="Your name"
                                   value="{{ old('name') }}">
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                   placeholder="your@email.com"
                                   value="{{ old('email') }}">
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" id="message" rows="5" required
                                      class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                      placeholder="Your message">{{ old('message') }}</textarea>
                            @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                            Send message
                        </button>
                    </form>
                </div>
                    </div>

                    <div class="lg:col-span-7 space-y-6">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Address</p>
                                <p class="mt-2 text-sm text-gray-700 whitespace-pre-line">{{ $address }}</p>
                            </div>

                            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Main phone</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="mt-2 inline-flex text-sm font-semibold text-ctc-blue hover:underline">
                                    {{ $phone }}
                                </a>
                                @if(!empty($appointmentsPhone))
                                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Appointments / referrals</p>
                                    <a href="tel:{{ preg_replace('/\s+/', '', $appointmentsPhone) }}" class="mt-2 inline-flex text-sm font-semibold text-ctc-blue hover:underline">
                                        {{ $appointmentsPhone }}
                                    </a>
                                @endif
                            </div>

                            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Email</p>
                                <a href="mailto:{{ $email }}" class="mt-2 inline-flex text-sm font-semibold text-ctc-blue hover:underline break-all">
                                    {{ $email }}
                                </a>
                                @if(!empty($fax))
                                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Fax</p>
                                    <p class="mt-2 text-sm font-semibold text-gray-800">{{ $fax }}</p>
                                @endif
                            </div>

                            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Emergency</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $emergency) }}" class="mt-2 inline-flex text-sm font-semibold text-gray-900 hover:underline">
                                    {{ $emergency }}
                                </a>
                                @if(!empty($whatsapp))
                                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">WhatsApp</p>
                                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}" class="mt-2 inline-flex text-sm font-semibold text-ctc-blue hover:underline">
                                        {{ $whatsapp }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-white">
                            <div class="flex items-center justify-between gap-4 px-6 py-4 border-b border-gray-200">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Find us</p>
                                    <p class="mt-1 text-sm font-semibold text-gray-900">AGC Tenwek Cardiothoracic Centre</p>
                                </div>
                                <span class="hidden sm:inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-semibold text-gray-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-ctc-gold)]"></span>
                                    Google Maps
                                </span>
                            </div>
                            <div class="aspect-[16/10]">
                                <iframe
                                    src="{{ $mapEmbedUrl }}"
                                    width="600"
                                    height="450"
                                    style="border:0; width:100%; height:100%;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Tenwek Cardiothoracic Centre on Google Maps"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
