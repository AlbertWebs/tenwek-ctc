<?php

namespace Database\Seeders;

use App\Models\ServiceCategoryPage;
use Illuminate\Database\Seeder;

/**
 * Default copy is aligned with public information about Tenwek Hospital and the Cardiothoracic Centre.
 * Admins should verify details on https://tenwekhosp.org/ and update as the hospital publishes changes.
 */
class ServiceCategoryPageSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->definitions() as $row) {
            $segment = $row['url_segment'];
            $data = collect($row)->except('url_segment')->all();
            ServiceCategoryPage::updateOrCreate(
                ['url_segment' => $segment],
                array_merge(['url_segment' => $segment], $data)
            );
        }
    }

    private function definitions(): array
    {
        return [
            [
                'url_segment' => 'cardiac-surgery',
                'admin_label' => 'Cardiac surgery (/services/cardiac-surgery)',
                'meta_title' => 'Cardiac & heart surgery',
                'meta_description' => 'Cardiac surgery at Tenwek Cardiothoracic Centre: open heart, valve, bypass, and congenital heart care for adults and children, part of Tenwek Hospital in Bomet, Kenya.',
                'intro_kicker' => 'Heart surgery',
                'intro_heading' => 'Cardiac surgery',
                'intro_subheading' => 'Adult and paediatric heart procedures at the Cardiothoracic Centre, Tenwek Hospital',
                'body_html' => <<<'HTML'
<p><strong>Tenwek Hospital</strong> is a mission hospital in Bomet County, Kenya, serving patients from across East Africa. The <strong>Cardiothoracic Centre (CTC)</strong> provides specialised heart surgery alongside intensive care, anaesthesia, nursing, and diagnostics, so patients receive coordinated care from first assessment through recovery.</p>
<h3>What cardiac surgery includes</h3>
<p>Our cardiac programme covers a broad range of adult and paediatric conditions. Common areas of focus include coronary artery disease, valve disease, congenital heart defects, and other structural heart problems that may require open or conventional surgical treatment.</p>
<ul>
<li>Open heart and related procedures</li>
<li>Coronary artery bypass (CABG) where clinically indicated</li>
<li>Heart valve repair and replacement</li>
<li>Care for paediatric and congenital heart disease</li>
<li>Perioperative support in ICU and step-down units</li>
</ul>
<h3>Why patients choose Tenwek</h3>
<p>The CTC is designed as a centre of excellence for cardiothoracic care in the region, combining clinical service with training and mentorship so that African patients can access high-quality surgery closer to home. The wider hospital campus includes operating theatres, critical care capacity, and outpatient services that support complex surgical pathways.</p>
<h3>Learn more on the main hospital site</h3>
<p>For the latest news, campus overview, and hospital-wide services, visit the official <a href="https://tenwekhosp.org/">Tenwek Hospital website</a> and the <a href="https://tenwekhosp.org/the-cardiothoracic-centre-of-tenwek-hospital/">Cardiothoracic Centre feature page</a>.</p>
HTML,
            ],
            [
                'url_segment' => 'thoracic-surgery',
                'admin_label' => 'Thoracic surgery (/services/thoracic-surgery)',
                'meta_title' => 'Thoracic & chest surgery',
                'meta_description' => 'Thoracic surgery at Tenwek CTC: lung, chest wall, and mediastinal procedures with multidisciplinary teams at Tenwek Hospital, Bomet, Kenya.',
                'intro_kicker' => 'Chest & lung surgery',
                'intro_heading' => 'Thoracic surgery',
                'intro_subheading' => 'Surgical care for lung, chest wall, and mediastinal conditions',
                'body_html' => <<<'HTML'
<p>The thoracic surgery service at the <strong>Cardiothoracic Centre</strong> works closely with anaesthesia, critical care, imaging, and nursing teams at <strong>Tenwek Hospital</strong> to evaluate and treat conditions of the lungs, chest wall, pleura, and mediastinum.</p>
<h3>Areas we address</h3>
<p>Patients may be referred for assessment of lung nodules and tumours, infections, chest wall problems, and selected mediastinal conditions. Each pathway is planned with safety, clear communication, and appropriate staging and diagnostics.</p>
<ul>
<li>Lung surgery and related thoracic oncology support</li>
<li>Chest wall and pleural procedures where indicated</li>
<li>Mediastinal evaluation and surgery in selected cases</li>
<li>Collaboration with respiratory medicine and diagnostics</li>
</ul>
<h3>Care in context</h3>
<p>Tenwek Hospital provides surgical, medical, and community programmes across western Kenya. The CTC extends that mission into complex chest surgery, aiming for outcomes that are evidence-based, compassionate, and sustainable for the region.</p>
<h3>Official information</h3>
<p>Explore hospital-wide surgical services and updates on <a href="https://tenwekhosp.org/">tenwekhosp.org</a>, including the <a href="https://tenwekhosp.org/surgical-services/">surgical services</a> section.</p>
HTML,
            ],
            [
                'url_segment' => 'diagnostics',
                'admin_label' => 'Diagnostics (/services/diagnostics)',
                'meta_title' => 'Heart & chest diagnostics',
                'meta_description' => 'Cardiothoracic diagnostics at Tenwek CTC: echocardiography, imaging, and tests that guide safe treatment decisions at Tenwek Hospital, Kenya.',
                'intro_kicker' => 'Tests & imaging',
                'intro_heading' => 'Diagnostics',
                'intro_subheading' => 'Accurate assessment before heart and chest treatment',
                'body_html' => <<<'HTML'
<p>High-quality <strong>diagnostics</strong> are essential for safe cardiothoracic care. At the CTC, imaging and physiological tests help our teams confirm diagnoses, plan surgery, and monitor recovery, always aligned with the wider clinical services of <strong>Tenwek Hospital</strong>.</p>
<h3>Typical modalities</h3>
<p>Depending on your condition, the team may use echocardiography (including transoesophageal studies when appropriate), ECG and rhythm assessment, laboratory tests, and cross-sectional imaging such as CT or MRI when available and clinically indicated.</p>
<ul>
<li>Echocardiography for structural and functional heart assessment</li>
<li>Imaging requests coordinated with hospital radiology</li>
<li>Pre-operative risk assessment and optimisation</li>
<li>Follow-up testing after surgery or intervention</li>
</ul>
<h3>Before you visit</h3>
<p>If you are travelling from outside Bomet, review referral letters, prior imaging, and medication lists. International patients may also wish to read our international patient information and contact the team early so appointments and logistics can be coordinated.</p>
<h3>Tenwek Hospital</h3>
<p>Facility information and contacts are published on <a href="https://tenwekhosp.org/">tenwekhosp.org</a>.</p>
HTML,
            ],
        ];
    }
}
