<?php

namespace App\Support\Seo;

use App\Models\ContactSetting;
use App\Models\SiteSetting;
use App\Support\PublicAssetUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Seo
{
    /**
     * Build page SEO meta + JSON-LD in one place.
     *
     * @param array<string, mixed> $overrides
     */
    public static function build(Request $request, array $overrides = []): array
    {
        $siteName = config('ctc.name');
        $hospital = config('ctc.hospital');

        $baseTitle = "{$siteName} | {$hospital}";
        $defaultTitle = $baseTitle;
        $defaultDescription = config('ctc.tagline');

        $url = $request->fullUrl();
        $canonical = $overrides['canonical'] ?? $request->url();
        $canonical = self::absoluteUrl($request, $canonical);

        $defaultImage = PublicAssetUrl::toUrl('ctc.jpg') ?? self::absoluteUrl($request, '/ctc.jpg');
        $image = $overrides['image'] ?? $defaultImage;
        $image = self::absoluteUrl($request, $image);

        $routeName = $request->route()?->getName();
        $routeDefaults = self::defaultsForRoute($routeName, $overrides);

        $title = $overrides['title'] ?? $routeDefaults['title'] ?? $defaultTitle;
        $title = self::normalizeTitle($title, $baseTitle);

        $description = $overrides['description'] ?? $routeDefaults['description'] ?? $defaultDescription;
        $description = self::normalizeDescription($description);

        $keywords = $overrides['keywords'] ?? $routeDefaults['keywords'] ?? null;
        $robots = $overrides['robots'] ?? 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1';

        $locale = str_replace('_', '-', app()->getLocale());
        $type = $overrides['og_type'] ?? $routeDefaults['og_type'] ?? 'website';

        $contact = ContactSetting::current();
        $social = array_filter([
            'https://www.instagram.com/agctenwekcardiothoraciccentre',
            'https://www.linkedin.com/in/agctenwek-cardiothoracic-centre-6257b1368',
            'https://www.facebook.com/share/1DVKQQxtz5/',
            'https://www.tiktok.com/@agc_tenwek',
            SiteSetting::getValue('social.x'),
            SiteSetting::getValue('social.youtube'),
        ]);

        $schemas = [];
        $schemas[] = self::schemaWebSite($request, $siteName);
        $schemas[] = self::schemaOrganization($request, $siteName, $hospital, $contact, $social, $defaultImage);

        if (!empty($overrides['breadcrumbs']) && is_array($overrides['breadcrumbs'])) {
            $schemas[] = self::schemaBreadcrumbs($request, $overrides['breadcrumbs']);
        }

        if (!empty($overrides['schema']) && is_array($overrides['schema'])) {
            // Allow pages to inject extra JSON-LD blocks (e.g., Article).
            foreach ($overrides['schema'] as $block) {
                if (is_array($block)) {
                    $schemas[] = $block;
                }
            }
        }

        // Add WebPage last (it can reference breadcrumbs/org).
        $schemas[] = self::schemaWebPage($request, $title, $description, $canonical, $image);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonical,
            'robots' => $robots,
            'og' => [
                'type' => $type,
                'url' => $canonical,
                'title' => $overrides['og_title'] ?? $title,
                'description' => $overrides['og_description'] ?? $description,
                'image' => $image,
                'site_name' => $siteName,
                'locale' => $locale,
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $overrides['twitter_title'] ?? $title,
                'description' => $overrides['twitter_description'] ?? $description,
                'image' => $image,
            ],
            'meta' => [
                'author' => $overrides['author'] ?? $hospital,
                'language' => $locale,
                'geo_region' => 'KE',
                'geo_placename' => 'Bomet, Kenya',
            ],
            'schema' => array_values(array_filter($schemas)),
        ];
    }

    /** @return array<string, mixed> */
    private static function defaultsForRoute(?string $routeName, array $overrides): array
    {
        $siteName = config('ctc.name');
        $hospital = config('ctc.hospital');

        $map = [
            'home' => [
                'title' => "Cardiothoracic Centre at {$hospital} | Cardiac & Thoracic Surgery in Kenya",
                'description' => "Tenwek {$siteName} provides specialist cardiothoracic care in Kenya and East Africa: cardiac surgery, thoracic surgery, diagnostics, referrals, training and research.",
                'keywords' => 'cardiothoracic centre, tenwek, cardiac surgery kenya, thoracic surgery kenya, heart surgery east africa, cardiothoracic hospital kenya',
            ],
            'about' => [
                'title' => "About {$siteName} | Tenwek Hospital Cardiothoracic Centre",
                'description' => "Learn about Tenwek {$siteName}: who we are, our mission and vision, core values, and our commitment to safe, compassionate heart and chest care in East Africa.",
                'keywords' => 'about tenwek cardiothoracic centre, mission vision, core values, heart surgery kenya',
            ],
            'history' => [
                'title' => "History | {$siteName} at {$hospital}",
                'description' => "Key milestones in the growth of Tenwek Cardiothoracic Centre and its impact expanding access to advanced cardiac care across Africa.",
                'keywords' => 'tenwek cardiothoracic centre history, milestones, cardiac care africa',
            ],
            'services' => [
                'title' => "Services | Cardiac Surgery, Thoracic Surgery & Diagnostics | {$siteName}",
                'description' => "Explore Tenwek CTC services: adult and paediatric cardiac surgery, thoracic surgery, and advanced diagnostics with multidisciplinary specialist teams.",
                'keywords' => 'cardiac surgery, thoracic surgery, cardiothoracic services kenya, diagnostics, heart valve surgery, bypass surgery',
            ],
            'specialists' => [
                'title' => "Our Specialists | {$siteName}",
                'description' => "Meet the surgeons and care team at Tenwek Cardiothoracic Centre providing specialist cardiac and thoracic care across East Africa.",
                'keywords' => 'cardiothoracic surgeons kenya, cardiac specialists tenwek, thoracic surgeon kenya',
            ],
            'news' => [
                'title' => "News & Media | {$siteName}",
                'description' => "Updates, events and announcements from Tenwek Cardiothoracic Centre: symposiums, training, milestones and stories from the CTC.",
                'keywords' => 'tenwek ctc news, cardiothoracic symposium kenya, events, announcements',
            ],
            'news.show' => [
                'og_type' => 'article',
            ],
            'gallery' => [
                'title' => "Gallery | {$siteName}",
                'description' => "Photo gallery from Tenwek Cardiothoracic Centre: people, care, facility and community.",
                'keywords' => 'tenwek ctc gallery, cardiothoracic centre photos',
            ],
            'contact' => [
                'title' => "Contact | {$siteName}",
                'description' => "Contact Tenwek Cardiothoracic Centre for appointments, referrals, media enquiries and general questions. Located at Tenwek Hospital, Bomet, Kenya.",
                'keywords' => 'contact tenwek ctc, cardiothoracic referrals kenya, book appointment',
                'og_type' => 'website',
            ],
            'book-appointment' => [
                'title' => "Book Appointment | {$siteName}",
                'description' => "Request an appointment or consultation at Tenwek Cardiothoracic Centre. Submit details online for referrals and scheduling.",
                'keywords' => 'book appointment tenwek, cardiothoracic appointment kenya, referral form',
            ],
            'training' => [
                'title' => "Training | {$siteName}",
                'description' => "Training programmes at Tenwek CTC: fellowships, rotations and capacity building in cardiothoracic surgery and perioperative care.",
                'keywords' => 'cardiothoracic training africa, fellowship kenya, surgical training tenwek',
            ],
            'research' => [
                'title' => "Research | {$siteName}",
                'description' => "Research at Tenwek CTC: publications, outcomes research and learning that strengthens cardiothoracic care in resource-limited settings.",
                'keywords' => 'cardiothoracic research, outcomes research, tenwek publications',
            ],
            'research.publications' => [
                'title' => "Research Publications | {$siteName}",
                'description' => "Peer‑reviewed publications and research outputs from Tenwek Cardiothoracic Centre.",
                'keywords' => 'tenwek publications, cardiothoracic research papers',
            ],
            'training.fellowship-rotations' => [
                'title' => "Fellowship & Rotations | {$siteName}",
                'description' => "Fellowship and rotations at Tenwek CTC: supervised clinical training in adult and paediatric cardiac and thoracic surgery.",
                'keywords' => 'cardiothoracic fellowship kenya, rotations, training tenwek',
            ],
            'international-patients' => [
                'title' => "International Patients | {$siteName}",
                'description' => "Guidance for international patients seeking cardiothoracic care at Tenwek: referrals, records, travel planning and coordinated support.",
                'keywords' => 'international patients kenya cardiac surgery, medical travel tenwek',
            ],
            'impact' => [
                'title' => "Impact | {$siteName}",
                'description' => "Impact stories and outcomes from Tenwek CTC: patient stories, training, and expanded access to life‑saving care across Africa.",
                'keywords' => 'tenwek ctc impact, patient stories, cardiac surgery africa',
            ],
            'support' => [
                'title' => "Support the CTC | {$siteName}",
                'description' => "Support Tenwek Cardiothoracic Centre through giving and partnership to expand access to surgery and training.",
                'keywords' => 'donate tenwek ctc, support cardiothoracic surgery kenya, charity',
            ],
            'privacy-policy' => [
                'title' => "Privacy Policy | {$siteName}",
                'description' => "Privacy policy for Tenwek Cardiothoracic Centre website.",
            ],
            'terms-of-service' => [
                'title' => "Terms of Service | {$siteName}",
                'description' => "Terms of service for Tenwek Cardiothoracic Centre website.",
            ],
            'feedback' => [
                'title' => "Feedback & Complaints | {$siteName}",
                'description' => "Submit feedback or complaints to Tenwek Cardiothoracic Centre. We take patient experience seriously.",
            ],
        ];

        $defaults = $routeName ? ($map[$routeName] ?? []) : [];

        // If a controller already set legacy vars, respect them.
        if (!empty($overrides['pageTitle'])) {
            $defaults['title'] = $overrides['pageTitle'];
        }

        return $defaults;
    }

    private static function normalizeTitle(string $title, string $baseTitle): string
    {
        $title = trim($title);
        if ($title === '') {
            return $baseTitle;
        }
        if (Str::contains($title, config('ctc.name'))) {
            return $title;
        }
        return "{$title} | " . $baseTitle;
    }

    private static function normalizeDescription(?string $description): string
    {
        $description = trim((string) $description);
        $description = preg_replace('/\s+/', ' ', $description) ?: '';
        return Str::limit($description, 160, '…');
    }

    private static function absoluteUrl(Request $request, ?string $url): ?string
    {
        if (!$url) return null;
        if (Str::startsWith($url, ['http://', 'https://'])) return $url;
        return rtrim($request->getSchemeAndHttpHost(), '/') . '/' . ltrim($url, '/');
    }

    /** @return array<string, mixed> */
    private static function schemaWebSite(Request $request, string $siteName): array
    {
        $base = rtrim($request->getSchemeAndHttpHost(), '/');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $base . '/#website',
            'name' => $siteName,
            'url' => $base . '/',
            'inLanguage' => str_replace('_', '-', app()->getLocale()),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $base . '/news?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /** @return array<string, mixed> */
    private static function schemaWebPage(Request $request, string $title, string $description, string $canonical, string $image): array
    {
        $base = rtrim($request->getSchemeAndHttpHost(), '/');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => $canonical . '#webpage',
            'url' => $canonical,
            'name' => $title,
            'description' => $description,
            'inLanguage' => str_replace('_', '-', app()->getLocale()),
            'isPartOf' => ['@id' => $base . '/#website'],
            'about' => ['@id' => $base . '/#organization'],
            'primaryImageOfPage' => [
                '@type' => 'ImageObject',
                'url' => $image,
            ],
        ];
    }

    /** @param array<int, string> $sameAs */
    private static function schemaOrganization(Request $request, string $siteName, string $hospital, ContactSetting $contact, array $sameAs, string $logoUrl): array
    {
        $base = rtrim($request->getSchemeAndHttpHost(), '/');
        $address = trim((string) ($contact->address ?? ''));

        return [
            '@context' => 'https://schema.org',
            '@type' => ['MedicalOrganization', 'Hospital'],
            '@id' => $base . '/#organization',
            'name' => $siteName,
            'alternateName' => $hospital,
            'url' => $base . '/',
            'logo' => $logoUrl,
            'image' => $logoUrl,
            'sameAs' => array_values($sameAs),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressLocality' => 'Bomet',
                'addressRegion' => 'Bomet County',
                'addressCountry' => 'KE',
            ],
            'areaServed' => [
                ['@type' => 'Country', 'name' => 'Kenya'],
                ['@type' => 'Place', 'name' => 'East Africa'],
            ],
            'contactPoint' => array_values(array_filter([
                filled($contact->phone) ? [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer support',
                    'telephone' => $contact->phone,
                    'email' => $contact->email,
                    'areaServed' => 'KE',
                    'availableLanguage' => ['en'],
                ] : null,
                filled($contact->emergency_phone) ? [
                    '@type' => 'ContactPoint',
                    'contactType' => 'emergency',
                    'telephone' => $contact->emergency_phone,
                    'areaServed' => 'KE',
                    'availableLanguage' => ['en'],
                ] : null,
            ])),
        ];
    }

    /**
     * @param array<int, array{label: string, url: string}> $items
     * @return array<string, mixed>
     */
    private static function schemaBreadcrumbs(Request $request, array $items): array
    {
        $base = rtrim($request->getSchemeAndHttpHost(), '/');
        $list = [];
        $pos = 1;
        foreach ($items as $item) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $pos++,
                'name' => $item['label'],
                'item' => self::absoluteUrl($request, $item['url']),
            ];
        }
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            '@id' => $base . '/#breadcrumbs',
            'itemListElement' => $list,
        ];
    }
}

