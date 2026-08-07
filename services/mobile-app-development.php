<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'mobile-app-development',
    'title' => 'Mobile App Development',
    'icon' => 'fa-solid fa-mobile-screen-button',
    'heading' => 'Native and Cross-Platform Apps That Perform',
    'intro' => 'From Flutter cross-platform builds to native Kotlin and Swift apps, we deliver mobile experiences that perform well and ship on schedule.',
    'features' => [
        ['icon' => 'fa-solid fa-layer-group', 'title' => 'Cross-Platform Apps', 'text' => 'Single Flutter codebase shipping to both iOS and Android to save time and budget.'],
        ['icon' => 'fa-brands fa-apple', 'title' => 'Native iOS Development', 'text' => 'Swift-based apps for teams that need maximum platform performance and integration.'],
        ['icon' => 'fa-brands fa-android', 'title' => 'Native Android Development', 'text' => 'Kotlin-based apps built to Android platform standards and Play Store guidelines.'],
        ['icon' => 'fa-solid fa-bell', 'title' => 'Push Notifications & Offline Support', 'text' => 'Engagement features that keep apps useful even without a connection.'],
        ['icon' => 'fa-solid fa-store', 'title' => 'App Store Deployment', 'text' => 'We handle App Store and Google Play submission, review, and release management.'],
        ['icon' => 'fa-solid fa-arrows-rotate', 'title' => 'Ongoing App Maintenance', 'text' => 'OS updates, dependency upgrades, and bug fixes after launch.'],
    ],
    'benefits' => [
        'Cross-platform builds cut development cost without sacrificing quality',
        'Native builds unlock maximum performance for demanding use cases',
        'A polished mobile experience strengthens customer retention',
        'Ongoing maintenance keeps your app compatible with new OS releases',
    ],
    'technologies' => ['Flutter', 'Kotlin', 'Swift', 'Firebase', 'REST APIs', 'Git'],
    'faqs' => [
        ['question' => 'Should I build a native app or a cross-platform app?', 'answer' => 'Cross-platform Flutter apps are a strong fit for most businesses, offering one codebase for both iOS and Android. Native Swift or Kotlin apps make sense when you need maximum performance or deep platform-specific integration.'],
        ['question' => 'How long does mobile app development take?', 'answer' => 'A typical mobile app project runs 8-16 weeks depending on feature scope, design complexity, and platform requirements.'],
        ['question' => 'Do you handle App Store and Play Store submission?', 'answer' => 'Yes, we manage the full submission and review process for both the Apple App Store and Google Play Store.'],
        ['question' => 'Will the app work offline?', 'answer' => 'We can build offline support and local data caching where it makes sense for your use case, so the app stays usable without a network connection.'],
    ],
];

$meta = page_meta(
    'Mobile App Development Services | iOS, Android & Flutter | Muskiforge',
    'Muskiforge builds native iOS and Android apps and cross-platform Flutter apps engineered for performance, reliability, and a smooth user experience.',
    'services/mobile-app-development.php'
);

$extraSchema = schema_service($service['title'], $service['intro'], $service['slug'])
    . schema_faq($service['faqs'])
    . schema_breadcrumb([
        ['name' => 'Home', 'url' => url('index.php')],
        ['name' => 'Services', 'url' => url('services.php')],
        ['name' => $service['title'], 'url' => url('services/' . $service['slug'] . '.php')],
    ]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/service-template.php';
require __DIR__ . '/../includes/footer.php';
