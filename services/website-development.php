<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'website-development',
    'title' => 'Website Development',
    'icon' => 'fa-solid fa-globe',
    'heading' => 'Websites Built for Speed, Search, and Growth',
    'intro' => 'We design and build custom websites that combine clean UX, semantic HTML5, and Core Web Vitals performance out of the box — from marketing sites to complex web portals.',
    'features' => [
        ['icon' => 'fa-solid fa-pen-ruler', 'title' => 'Custom Design', 'text' => 'Original designs built around your brand, not a recycled template.'],
        ['icon' => 'fa-solid fa-mobile-screen', 'title' => 'Responsive Builds', 'text' => 'Pixel-accurate layouts across mobile, tablet, and desktop.'],
        ['icon' => 'fa-solid fa-gauge-high', 'title' => 'Performance Engineering', 'text' => 'Optimized assets, lazy loading, and caching for fast Core Web Vitals scores.'],
        ['icon' => 'fa-solid fa-magnifying-glass-chart', 'title' => 'SEO Foundations', 'text' => 'Semantic markup, structured data, and clean URL architecture from day one.'],
        ['icon' => 'fa-solid fa-lock', 'title' => 'Secure by Default', 'text' => 'HTTPS, hardened forms, and secure hosting configuration on every build.'],
        ['icon' => 'fa-solid fa-arrows-rotate', 'title' => 'CMS Integration', 'text' => 'Editable content via WordPress or a lightweight custom admin, your choice.'],
    ],
    'benefits' => [
        'Faster load times reduce bounce rate and improve conversion',
        'SEO-ready architecture accelerates organic search growth',
        'A maintainable codebase lowers the cost of future updates',
        'Consistent branding builds trust with visitors and customers',
    ],
    'technologies' => ['HTML5', 'CSS3', 'Bootstrap 5', 'React', 'PHP', 'WordPress', 'LiteSpeed Cache'],
    'faqs' => [
        ['question' => 'How long does a website build take?', 'answer' => 'Most marketing and brochure websites take 3-6 weeks from kickoff to launch, depending on the number of pages and custom functionality required.'],
        ['question' => 'Will my website be mobile-friendly?', 'answer' => 'Yes, every site we build is fully responsive and tested across common device sizes before launch.'],
        ['question' => 'Can I update the content myself after launch?', 'answer' => 'Yes. We typically build on a CMS such as WordPress, or a lightweight custom admin panel, so your team can update content without touching code.'],
        ['question' => 'Do you handle hosting and domain setup?', 'answer' => 'Yes, we can manage hosting, domain configuration, SSL certificates, and DNS, or work with your existing provider.'],
    ],
];

$meta = page_meta(
    'Website Development Services | Fast, Secure, SEO-Ready Sites | Muskiforge',
    'Muskiforge builds custom, responsive, SEO-optimized websites with fast load times and clean architecture for businesses of every size.',
    'services/website-development.php'
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
