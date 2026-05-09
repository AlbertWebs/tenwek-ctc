<?php

namespace App\Support;

use App\Models\SiteSetting;

class LegalPageContent
{
    public static function resolvedBody(string $key): string
    {
        $raw = (string) (SiteSetting::getValue($key, '') ?? '');
        if (filled(trim($raw))) {
            return $raw;
        }

        return match ($key) {
            'legal.privacy.body' => self::privacyHtml(),
            'legal.terms.body' => self::termsHtml(),
            default => '',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            'legal.privacy.body' => self::privacyHtml(),
            'legal.terms.body' => self::termsHtml(),
        ];
    }

    public static function privacyHtml(): string
    {
        $email = e(config('ctc.contact.email', 'ctc@tenwekhospital.org'));

        return <<<HTML
<p>This Privacy Policy explains how the Cardiothoracic Centre (CTC) at Tenwek Hospital collects, uses, and protects information submitted through this website.</p>

<h2>Information we collect</h2>
<ul>
<li>Contact details you submit (e.g. name, email, phone).</li>
<li>Messages and enquiry details you share through forms.</li>
<li>Basic technical data (e.g. browser type) for site performance and security.</li>
</ul>

<h2>How we use information</h2>
<ul>
<li>To respond to enquiries, requests, and referrals.</li>
<li>To improve our services and website experience.</li>
<li>For safety, fraud prevention, and compliance where required.</li>
</ul>

<h2>Sharing</h2>
<p>We do not sell personal information. We may share information internally with relevant clinical or administrative teams to respond to your request, and with service providers only when needed to operate this website.</p>

<h2>Security</h2>
<p>We apply reasonable technical and organisational measures to protect submitted information. No method of transmission or storage is 100% secure; if you have concerns, please contact us directly.</p>

<h2>Contact</h2>
<p>For privacy questions, please email <a href="mailto:{$email}">{$email}</a>.</p>
HTML;
    }

    public static function termsHtml(): string
    {
        return <<<HTML
<p>These Terms of Service govern use of the Cardiothoracic Centre (CTC) website. By using this website, you agree to these terms.</p>

<h2>Medical information</h2>
<p>Content on this website is for general information only and does not replace professional medical advice. For urgent medical needs, contact emergency services or Tenwek Hospital immediately.</p>

<h2>Appointments and enquiries</h2>
<p>The Book appointment page is for scheduling requests; the Contact page is for general messages. Submitting either form does not guarantee an appointment. Our team will review and respond as soon as possible.</p>

<h2>Acceptable use</h2>
<ul>
<li>Do not submit false, harmful, or unlawful content.</li>
<li>Do not attempt to disrupt the site or access restricted areas.</li>
</ul>

<h2>Changes</h2>
<p>We may update these terms to reflect service or legal changes. The latest version will be posted on this page.</p>
HTML;
    }
}
