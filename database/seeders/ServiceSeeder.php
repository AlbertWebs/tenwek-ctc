<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Cardiac Surgery
            ['category' => 'cardiac_surgery', 'name' => 'Adult Cardiac Surgery', 'description' => 'Comprehensive surgical care for adult heart conditions including coronary artery disease, valve disease, and heart failure.', 'sort_order' => 1],
            ['category' => 'cardiac_surgery', 'name' => 'Pediatric Cardiac Surgery', 'description' => 'Specialized care for children with congenital heart defects, from newborns to adolescents.', 'sort_order' => 2],
            ['category' => 'cardiac_surgery', 'name' => 'Valve Surgery', 'description' => 'Repair and replacement of heart valves for conditions such as stenosis and regurgitation.', 'sort_order' => 3],
            ['category' => 'cardiac_surgery', 'name' => 'Coronary Artery Bypass', 'description' => 'CABG and minimally invasive options for coronary artery disease.', 'sort_order' => 4],
            // Thoracic Surgery
            ['category' => 'thoracic_surgery', 'name' => 'Lung Surgery', 'description' => 'Diagnosis and surgical treatment of lung conditions including cancer, infections, and benign tumors.', 'sort_order' => 5],
            ['category' => 'thoracic_surgery', 'name' => 'Chest Tumors', 'description' => 'Evaluation and resection of chest wall and pleural tumors.', 'sort_order' => 6],
            ['category' => 'thoracic_surgery', 'name' => 'Mediastinal Conditions', 'description' => 'Management of mediastinal masses and other conditions of the chest cavity.', 'sort_order' => 7],
            // Diagnostics
            ['category' => 'diagnostics', 'name' => 'Echocardiography', 'description' => 'Transthoracic and transesophageal echocardiography for accurate cardiac assessment.', 'sort_order' => 8],
            ['category' => 'diagnostics', 'name' => 'Imaging', 'description' => 'CT, MRI, and other imaging services for cardiothoracic diagnosis.', 'sort_order' => 9],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['name' => $data['name'], 'category' => $data['category']],
                array_merge($data, [
                    'slug' => Str::slug($data['name']),
                    'is_visible' => true,
                ])
            );
        }
    }
}
