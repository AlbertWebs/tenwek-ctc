<?php

return [
    'menu' => [
        ['label' => 'Dashboard Home', 'route' => 'admin-dashboard.index', 'icon' => 'dashboard'],
        ['label' => 'About Section', 'route' => 'admin-dashboard.about.index', 'icon' => 'information-circle'],
        ['label' => 'Team / Staff', 'route' => 'admin-dashboard.team-members.index', 'icon' => 'users', 'permission' => 'team.manage'],
        ['label' => 'Services', 'route' => 'admin-dashboard.services.index', 'icon' => 'briefcase', 'permission' => 'services.manage'],
        ['label' => 'Patient Information', 'route' => 'admin-dashboard.patient-info.index', 'icon' => 'document-text'],
        ['label' => 'Training Programs', 'route' => 'admin-dashboard.training.index', 'icon' => 'academic-cap'],
        ['label' => 'Research / Publications', 'route' => 'admin-dashboard.research.index', 'icon' => 'book-open'],
        ['label' => 'Impact Stories', 'route' => 'admin-dashboard.impact.index', 'icon' => 'heart'],
        ['label' => 'Support / Donations', 'route' => 'admin-dashboard.donations.index', 'icon' => 'currency-dollar'],
        ['label' => 'News / Articles', 'route' => 'admin-dashboard.news.index', 'icon' => 'newspaper', 'permission' => 'news.manage'],
        ['label' => 'Contact & Enquiries', 'route' => 'admin-dashboard.enquiries.index', 'icon' => 'mail'],
        ['label' => 'Bookings / Appointments', 'route' => 'admin-dashboard.bookings.index', 'icon' => 'calendar'],
        ['label' => 'Specialists', 'route' => 'admin-dashboard.team-members.index', 'icon' => 'user-group'],
        ['label' => 'Users & Roles', 'route' => 'admin-dashboard.users.index', 'icon' => 'shield-check', 'permission' => 'users.manage'],
    ],
];
