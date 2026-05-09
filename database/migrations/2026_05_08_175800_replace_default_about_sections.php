<?php

use App\Models\AboutSection;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Replace old demo defaults (if present) with the new sections.
        AboutSection::query()
            ->whereIn('key', ['overview', 'history'])
            ->delete();

        AboutSection::updateOrCreate(
            ['key' => 'what-guides-our-care'],
            [
                'title' => 'What guides our care',
                'content' => 'A few principles that shape how we serve patients, families, and referring clinicians: compassion, excellence, teamwork, and stewardship.',
                'sort_order' => 0,
                'is_visible' => true,
            ]
        );

        AboutSection::updateOrCreate(
            ['key' => 'mission-and-vision'],
            [
                'title' => 'Mission & Vision',
                'content' => 'Mission: Provide excellent, compassionate cardiothoracic care and train the next generation of clinicians. Vision: A region where every person can access life‑saving heart and chest surgery delivered by well‑trained local teams.',
                'sort_order' => 1,
                'is_visible' => true,
            ]
        );
    }

    public function down(): void
    {
        // Non-destructive rollback: keep current content.
    }
};
