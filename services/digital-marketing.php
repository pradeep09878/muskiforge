<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'digital-marketing',
    'title' => 'Digital Marketing',
    'icon' => 'fa-solid fa-bullhorn',
    'heading' => 'Full-Funnel Marketing That Turns Traffic Into Pipeline',
    'intro' => 'We plan and run digital marketing programs spanning content strategy, paid media, social, and email to turn traffic into pipeline.',
    'features' => [
        ['icon' => 'fa-solid fa-file-lines', 'title' => 'Content Marketing', 'text' => 'Blog, resource, and landing page content built around what your buyers search for.'],
        ['icon' => 'fa-solid fa-money-bill-trend-up', 'title' => 'Paid Media (PPC)', 'text' => 'Google Ads and social ad campaigns managed toward measurable ROI, not just clicks.'],
        ['icon' => 'fa-brands fa-facebook', 'title' => 'Social Media Marketing', 'text' => 'Organic and paid social strategy tailored to where your audience actually is.'],
        ['icon' => 'fa-solid fa-envelope-open-text', 'title' => 'Email Marketing', 'text' => 'Nurture sequences and campaigns that keep leads engaged through the funnel.'],
        ['icon' => 'fa-solid fa-chart-pie', 'title' => 'Conversion Rate Optimization', 'text' => 'Landing page testing to improve how much of your traffic actually converts.'],
        ['icon' => 'fa-solid fa-chart-simple', 'title' => 'Analytics & Reporting', 'text' => 'Clear dashboards tying marketing activity back to pipeline and revenue.'],
    ],
    'benefits' => [
        'A coordinated strategy across channels instead of disconnected campaigns',
        'Better cost-per-lead through continuous testing and optimization',
        'Clear attribution from marketing spend to actual revenue impact',
        'Content and campaigns that compound in value rather than one-off spend',
    ],
    'technologies' => ['Google Ads', 'Google Analytics', 'Meta Ads', 'Mailchimp', 'HubSpot'],
    'faqs' => [
        ['question' => 'What channels does Muskiforge manage?', 'answer' => 'We manage content marketing, paid search and social ads, organic social, and email marketing, coordinated as one strategy rather than separate silos.'],
        ['question' => 'How do you measure marketing success?', 'answer' => 'We tie campaigns to concrete metrics — cost per lead, conversion rate, and ultimately pipeline and revenue — and report on them monthly.'],
        ['question' => 'Do you require a long-term contract?', 'answer' => 'We offer both project-based campaigns and ongoing monthly retainers; the right structure depends on your goals.'],
        ['question' => 'Can you work alongside our in-house marketing team?', 'answer' => 'Yes, we frequently collaborate with in-house marketers, handling specific channels or execution while your team owns strategy and brand.'],
    ],
];

$meta = page_meta(
    'Digital Marketing Services | Content, Paid Media & Social | Muskiforge',
    'Muskiforge runs full-funnel digital marketing programs across content, paid media, social, and email to turn traffic into pipeline.',
    'services/digital-marketing.php'
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
