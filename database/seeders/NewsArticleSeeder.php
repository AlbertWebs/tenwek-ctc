<?php

namespace Database\Seeders;

use App\Models\NewsArticle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'CTC Celebrates 5,000 Heart Surgeries',
                'slug' => 'ctc-celebrates-5000-heart-surgeries',
                'type' => 'news',
                'excerpt' => 'The Cardiothoracic Centre at Tenwek Hospital has reached a major milestone, performing over 5,000 open heart surgeries since its founding.',
                'body' => '<p>This milestone reflects the dedication of our team and the trust of patients and referring physicians across East Africa. We continue to expand capacity and training to serve more families.</p>',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Annual Cardiology Symposium 2025',
                'slug' => 'annual-cardiology-symposium-2025',
                'type' => 'event',
                'excerpt' => 'Join us for the annual cardiology and cardiothoracic surgery symposium, bringing together regional experts and trainees.',
                'body' => '<p>Date and venue to be announced. The symposium will include live cases, lectures, and workshops for physicians and allied health professionals.</p>',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'New Fellowship Class Welcomed',
                'slug' => 'new-fellowship-class-welcomed',
                'type' => 'announcement',
                'excerpt' => 'We are pleased to welcome the new class of cardiothoracic surgery fellows to Tenwek Hospital.',
                'body' => '<p>Our fellowship program continues to train the next generation of cardiothoracic surgeons for Africa. Applications for the next cycle will open later this year.</p>',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Partnership with International Heart Foundation',
                'slug' => 'partnership-international-heart-foundation',
                'type' => 'news',
                'excerpt' => 'Tenwek CTC announces a new partnership to support pediatric cardiac surgery and training.',
                'body' => '<p>This partnership will enable more children to receive life-saving surgery and strengthen our training programs in congenital heart disease.</p>',
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($articles as $data) {
            NewsArticle::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_published' => true])
            );
        }
    }
}
