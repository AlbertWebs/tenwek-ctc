<footer class="bg-ctc-blue-dark text-white mt-auto" role="contentinfo">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <div class="lg:col-span-2">
                <h2 class="text-xl font-semibold mb-4">{{ config('ctc.name') }}</h2>
                <p class="text-gray-300 text-sm leading-relaxed max-w-md">{{ config('ctc.hospital') }}. {{ config('ctc.tagline') }}.</p>
            </div>
            <div>
                <h3 class="font-semibold mb-3 text-sm uppercase tracking-wide text-gray-400">Quick links</h3>
                <ul class="space-y-2 text-sm">
                    @foreach(array_slice(config('ctc.nav'), 0, 5) as $item)
                        <li><a href="{{ route($item['route']) }}" class="text-gray-300 hover:text-white transition-colors">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-3 text-sm uppercase tracking-wide text-gray-400">Contact</h3>
                <address class="text-sm text-gray-300 not-italic space-y-2">
                    <p>{{ config('ctc.contact.address') }}</p>
                    <p><a href="tel:{{ preg_replace('/\s+/', '', config('ctc.contact.phone')) }}" class="hover:text-white transition-colors">{{ config('ctc.contact.phone') }}</a></p>
                    <p><a href="mailto:{{ config('ctc.contact.email') }}" class="hover:text-white transition-colors">{{ config('ctc.contact.email') }}</a></p>
                </address>
            </div>
        </div>
        <div class="mt-10 pt-8 border-t border-white/10 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} {{ config('ctc.hospital') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
