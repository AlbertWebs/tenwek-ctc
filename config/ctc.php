<?php

return [
    'name' => 'Cardiothoracic Centre',
    'hospital' => 'Tenwek Hospital',
    'tagline' => 'Excellence in Cardiothoracic Care in East Africa',

    /*
    | Hero background video (landing page). YouTube URL or path under public/ (e.g. 'videos/hero.mp4').
    | YouTube embeds autoplay muted and loop; use HD/4K source on YouTube for best quality.
    | Leave null to use gradient-only background.
    */
    'hero_video' => env('CTC_HERO_VIDEO', 'https://www.youtube.com/watch?v=_kRrI-5-SX0'),

    /*
    | Banner image for inner pages (About, Team, Services, etc.). Used with a gradient overlay.
    */
    'page_banner_image' => env('CTC_PAGE_BANNER_IMAGE', 'https://tenwekhosp.org/wp-content/uploads/2024/03/DJI_0855.jpg'),

    'demo_surgeries' => (int) env('CTC_DEMO_SURGERIES', 5000),

    'contact' => [
        'address' => 'Tenwek Hospital, P.O. Box 39, Bomet, Kenya',
        'phone' => '+254 (0) 20 204 5000',
        'email' => 'ctc@tenwekhospital.org',
        'emergency' => '+254 (0) 729 411 211',
    ],

    'nav' => [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Team', 'route' => 'team'],
        ['label' => 'Services', 'route' => 'services'],
        ['label' => 'Patient Info', 'route' => 'patient-information'],
        ['label' => 'Training', 'route' => 'training'],
        ['label' => 'Research', 'route' => 'research'],
        ['label' => 'Impact', 'route' => 'impact'],
        ['label' => 'Support', 'route' => 'support'],
        ['label' => 'News', 'route' => 'news'],
        ['label' => 'Contact', 'route' => 'contact'],
    ],
];
