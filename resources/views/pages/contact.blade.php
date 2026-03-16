@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Contact Us',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send a message</h2>
                    <form action="{{ route('contact') }}" method="post" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                   placeholder="Your name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                   placeholder="your@email.com">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" id="message" rows="5" required
                                      class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-ctc-blue focus:border-ctc-blue"
                                      placeholder="Your message"></textarea>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-ctc-blue text-white hover:bg-ctc-blue-dark transition-colors">
                            Send message
                        </button>
                    </form>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact information</h2>
                    <div class="space-y-6 text-gray-600">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Address</h3>
                            <p>{{ config('ctc.contact.address') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Phone</h3>
                            <p><a href="tel:{{ preg_replace('/\s+/', '', config('ctc.contact.phone')) }}" class="text-ctc-blue hover:underline">{{ config('ctc.contact.phone') }}</a></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">Email</h3>
                            <p><a href="mailto:{{ config('ctc.contact.email') }}" class="text-ctc-blue hover:underline">{{ config('ctc.contact.email') }}</a></p>
                        </div>
                    </div>

                    <div class="mt-10 rounded-xl overflow-hidden border border-gray-200 shadow-sm aspect-video">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.482886613467!2d35.354772200000006!3d-0.7429635000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182b99e773d0b419%3A0x9a894bffe3e322cd!2sTenwek%20Cardiothoracic%20Centre!5e0!3m2!1sen!2snl!4v1773660558373!5m2!1sen!2snl"
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
    </section>
@endsection
