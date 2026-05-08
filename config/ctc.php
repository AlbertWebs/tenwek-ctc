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

    /*
    | Social links (optional). Use full URLs or leave null.
    */
    'social' => [
        'Facebook' => env('CTC_SOCIAL_FACEBOOK'),
        'X' => env('CTC_SOCIAL_X'),
        'Instagram' => env('CTC_SOCIAL_INSTAGRAM'),
        'YouTube' => env('CTC_SOCIAL_YOUTUBE'),
        'LinkedIn' => env('CTC_SOCIAL_LINKEDIN'),
    ],

    /*
    | Main menu (navbar): Home, About, Team, Services, Training, Research, Impact, Support.
    */
    'nav' => [
        ['label' => 'Home', 'route' => 'home'],
        [
            'label' => 'About CTC',
            'route' => 'about',
            'children' => [
                ['label' => 'Overview', 'route' => 'about'],
                ['label' => 'History', 'route' => 'history'],
                ['label' => 'Our Specialists', 'route' => 'specialists'],
                ['label' => 'Impact', 'route' => 'impact'],
            ],
        ],
        [
            'label' => 'Our Services',
            'route' => 'services',
            'dropdown' => 'mega',
            'groups' => [
                [
                    'title' => 'Services',
                    'links' => [
                        ['label' => 'Cardiac Surgery', 'url' => '/services#cardiac_surgery'],
                        ['label' => 'Thoracic Surgery', 'url' => '/services#thoracic_surgery'],
                        ['label' => 'Diagnostics', 'url' => '/services#diagnostics'],
                        ['label' => 'All Services', 'route' => 'services'],
                    ],
                ],
                [
                    'title' => 'Patient pathway',
                    'links' => [
                        ['label' => 'Book Appointment', 'route' => 'contact'],
                        ['label' => 'Refer a Patient', 'route' => 'patient-information'],
                        ['label' => 'International Patients', 'route' => 'international-patients'],
                    ],
                ],
            ],
        ],
        ['label' => 'Our Specialists', 'route' => 'specialists'],
        [
            'label' => 'Training & Research',
            'route' => 'training-research',
            'dropdown' => 'mega',
            'groups' => [
                [
                    'title' => 'Training',
                    'links' => [
                        ['label' => 'Training overview', 'route' => 'training'],
                        ['label' => 'Fellowship & rotations', 'route' => 'training.fellowship-rotations'],
                    ],
                ],
                [
                    'title' => 'Research',
                    'links' => [
                        ['label' => 'Research overview', 'route' => 'research'],
                        ['label' => 'Publications', 'route' => 'research.publications'],
                    ],
                ],
                [
                    'title' => 'Explore',
                    'links' => [
                        ['label' => 'Training & Research hub', 'route' => 'training-research'],
                        ['label' => 'News & Media', 'route' => 'news'],
                    ],
                ],
            ],
        ],
        ['label' => 'News & Media', 'route' => 'news'],
        ['label' => 'Contact Us', 'route' => 'contact'],
    ],

    /*
    | Footer links: Patient Info, News, Contact (and any other secondary links).
    */
    'footer' => [
        'description' => env('CTC_FOOTER_DESCRIPTION', 'A specialised cardiothoracic centre of Tenwek Hospital, providing advanced heart and chest care, training, and research in East Africa.'),
        'columns' => [
            [
                'title' => 'The Centre',
                'links' => [
                    ['label' => 'About CTC', 'route' => 'about'],
                    ['label' => 'Our Services', 'route' => 'services'],
                    ['label' => 'Our Specialists', 'route' => 'specialists'],
                    ['label' => 'Patient Information', 'route' => 'patient-information'],
                    ['label' => 'International Patients', 'route' => 'international-patients'],
                ],
            ],
            [
                'title' => 'Training & Research',
                'links' => [
                    ['label' => 'Training & Research', 'route' => 'training-research'],
                    ['label' => 'Training', 'route' => 'training'],
                    ['label' => 'Research', 'route' => 'research'],
                ],
            ],
            [
                'title' => 'Updates',
                'links' => [
                    ['label' => 'News & Media', 'route' => 'news'],
                    ['label' => 'Impact', 'route' => 'impact'],
                    ['label' => 'Support the CTC', 'route' => 'support'],
                    ['label' => 'Contact Us', 'route' => 'contact'],
                ],
            ],
        ],
        'legal_links' => [
            ['label' => 'Privacy Policy', 'url' => '/privacy-policy'],
            ['label' => 'Terms of Service', 'url' => '/terms-of-service'],
            ['label' => 'Feedback & Complaints', 'url' => '/feedback-and-complaints'],
            ['label' => 'Admin Login', 'url' => '/admin-dashboard/login'],
        ],
    ],
];
