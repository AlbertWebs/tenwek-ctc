<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\Booking;
use App\Models\ContactEnquiry;
use App\Models\CoreValue;
use App\Models\Donation;
use App\Models\ImpactStory;
use App\Models\PatientInfoBlock;
use App\Models\ResearchPublication;
use App\Models\TrainingProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminDemoSeeder extends Seeder
{
    public function run(): void
    {
        // About page defaults (keep aligned with the public About page sections)
        foreach ([
            [
                'key' => 'what-guides-our-care',
                'title' => 'What guides our care',
                'content' => 'A few principles that shape how we serve patients, families, and referring clinicians: compassion, excellence, teamwork, and stewardship.',
                'sort_order' => 0,
            ],
            [
                'key' => 'mission-and-vision',
                'title' => 'Mission & Vision',
                'content' => 'Mission: Provide excellent, compassionate cardiothoracic care and train the next generation of clinicians. Vision: A region where every person can access life‑saving heart and chest surgery delivered by well‑trained local teams.',
                'sort_order' => 1,
            ],
        ] as $s) {
            AboutSection::updateOrCreate(['key' => $s['key']], array_merge($s, ['is_visible' => true]));
        }

        foreach ([
            ['title' => 'Compassion', 'description' => 'We treat every patient with dignity, empathy, and respect.', 'sort_order' => 0],
            ['title' => 'Excellence', 'description' => 'We pursue high standards and continuous improvement.', 'sort_order' => 1],
            ['title' => 'Teamwork', 'description' => 'Care is coordinated across disciplines and services.', 'sort_order' => 2],
            ['title' => 'Stewardship', 'description' => 'We use resources wisely to help more people safely.', 'sort_order' => 3],
        ] as $v) {
            CoreValue::updateOrCreate(['title' => $v['title']], array_merge($v, ['is_visible' => true]));
        }

        foreach ([
            ['key' => 'how-to-become-patient', 'title' => 'How to Become a Patient', 'content' => 'Most patients are referred by a physician. Your referring physician can contact us to start the process.', 'sort_order' => 0],
            ['key' => 'what-to-bring', 'title' => 'What to Bring', 'content' => 'Please bring your referral letter, previous medical records, and identification.', 'sort_order' => 1],
        ] as $b) {
            PatientInfoBlock::firstOrCreate(['key' => $b['key']], array_merge($b, ['is_visible' => true]));
        }

        foreach ([
            ['title' => 'Cardiothoracic Fellowship', 'description' => 'Our fellowship program trains surgeons in adult and pediatric cardiac surgery and thoracic surgery.', 'duration' => '2 years', 'sort_order' => 0],
            ['title' => 'Short-term Observerships', 'description' => 'Observerships for visiting surgeons and trainees.', 'duration' => '2–12 weeks', 'sort_order' => 1],
        ] as $p) {
            TrainingProgram::firstOrCreate(
                ['title' => $p['title']],
                array_merge($p, ['slug' => Str::slug($p['title']), 'is_visible' => true])
            );
        }

        foreach ([
            ['title' => 'Outcomes in valve surgery in resource-limited settings', 'authors' => 'Smith J, et al.', 'journal' => 'Journal of Cardiac Surgery', 'year' => '2023', 'sort_order' => 0],
            ['title' => 'Training effectiveness in East African cardiothoracic programs', 'authors' => 'Multiple authors', 'journal' => 'World Journal of Surgery', 'year' => '2022', 'sort_order' => 1],
        ] as $r) {
            ResearchPublication::firstOrCreate(
                ['title' => $r['title']],
                array_merge($r, ['is_visible' => true])
            );
        }

        foreach ([
            ['title' => 'A child’s second chance', 'story' => 'Young patient from rural Kenya received life-saving heart surgery at the CTC.', 'story_date' => now()->subMonths(2), 'sort_order' => 0],
            ['title' => 'Building surgical capacity in the region', 'story' => 'How the CTC has expanded access to cardiothoracic care across East Africa.', 'story_date' => now()->subMonths(4), 'sort_order' => 1],
        ] as $i) {
            ImpactStory::firstOrCreate(
                ['title' => $i['title']],
                array_merge($i, ['is_visible' => true])
            );
        }

        if (Booking::count() < 5) {
            for ($i = 0; $i < 8; $i++) {
                Booking::create([
                    'patient_name' => 'Demo Patient '.($i + 1),
                    'email' => 'patient'.($i + 1).'@example.com',
                    'phone' => '+254 7'.rand(10, 99).' '.rand(100000, 999999),
                    'requested_date' => now()->addDays(rand(5, 60)),
                    'status' => ['pending', 'pending', 'confirmed', 'completed', 'cancelled'][rand(0, 4)],
                    'type' => 'appointment',
                    'notes' => 'Demo booking.',
                ]);
            }
        }

        if (Donation::count() < 5) {
            $campaigns = ['General', 'Equipment', 'Patient support', null];
            for ($i = 0; $i < 12; $i++) {
                $date = now()->subMonths(rand(0, 5))->subDays(rand(0, 28));
                Donation::create([
                    'donor_name' => 'Donor '.($i + 1),
                    'email' => 'donor'.($i + 1).'@example.com',
                    'amount' => rand(500, 50000),
                    'currency' => 'KES',
                    'campaign' => $campaigns[array_rand($campaigns)],
                    'payment_method' => ['M-Pesa', 'Stripe', 'Bank'][rand(0, 2)],
                    'donated_at' => $date,
                    'notes' => 'Demo donation.',
                ]);
            }
        }

        if (ContactEnquiry::count() < 3) {
            ContactEnquiry::create(['name' => 'Demo Enquiry 1', 'email' => 'enquiry1@example.com', 'subject' => 'Partnership', 'message' => 'We would like to explore a partnership with the CTC.', 'source' => 'contact', 'status' => ContactEnquiry::STATUS_NEW]);
            ContactEnquiry::create(['name' => 'Demo Enquiry 2', 'email' => 'enquiry2@example.com', 'subject' => 'Support: sponsor', 'message' => 'I would like to sponsor a surgery.', 'source' => 'support-sponsor', 'status' => ContactEnquiry::STATUS_NEW]);
        }
    }
}
