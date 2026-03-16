<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Dr. John Kamau',
                'title' => 'Director, Cardiothoracic Centre',
                'specialization' => 'Adult & Pediatric Cardiac Surgery',
                'bio' => 'Dr. Kamau leads the CTC with over 20 years of experience in cardiac surgery. He has trained surgeons across East Africa and is committed to expanding access to life-saving heart surgery.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. Grace Wanjiku',
                'title' => 'Consultant Cardiothoracic Surgeon',
                'specialization' => 'Valve Surgery & Coronary Artery Bypass',
                'bio' => 'Dr. Wanjiku specializes in complex valve repair and replacement, as well as coronary artery bypass grafting. She is actively involved in fellowship training.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Peter Ochieng',
                'title' => 'Consultant Thoracic Surgeon',
                'specialization' => 'Lung Surgery & Chest Tumors',
                'bio' => 'Dr. Ochieng leads the thoracic surgery program, with expertise in lung resection, mediastinal conditions, and chest wall reconstruction.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Dr. Mary Akinyi',
                'title' => 'Pediatric Cardiac Surgeon',
                'specialization' => 'Congenital Heart Disease',
                'bio' => 'Dr. Akinyi is dedicated to caring for children with congenital heart defects. She has helped establish pediatric cardiac services across the region.',
                'sort_order' => 4,
            ],
        ];

        foreach ($members as $data) {
            TeamMember::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['photo' => null, 'is_visible' => true])
            );
        }
    }
}
