<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'seo-services',
    'title' => 'SEO Services',
    'icon' => 'fa-solid fa-magnifying-glass-chart',
    'heading' => 'SEO Built for Google, Bing, and AI Search',
    'intro' => 'Our SEO practice covers technical audits, entity and semantic SEO, structured data, and AI citation optimization for Google, Bing, and AI answer engines like ChatGPT, Gemini, and Perplexity.',
    'features' => [
        ['icon' => 'fa-solid fa-magnifying-glass', 'title' => 'Technical SEO Audits', 'text' => 'Crawlability, indexation, Core Web Vitals, and site architecture reviews.'],
        ['icon' => 'fa-solid fa-diagram-project', 'title' => 'Entity & Semantic SEO', 'text' => 'Content structured around topics and entities search engines already understand.'],
        ['icon' => 'fa-solid fa-code', 'title' => 'Structured Data', 'text' => 'Schema.org markup for organizations, services, FAQs, and breadcrumbs.'],
        ['icon' => 'fa-solid fa-robot', 'title' => 'AI Citation Optimization', 'text' => 'Content formatted to be cited accurately by AI Overviews, ChatGPT, and Perplexity.'],
        ['icon' => 'fa-solid fa-file-lines', 'title' => 'Content Strategy', 'text' => 'Topic clusters and comprehensive service pages that build topical authority.'],
        ['icon' => 'fa-solid fa-chart-line', 'title' => 'Rank Tracking & Reporting', 'text' => 'Transparent monthly reporting on rankings, traffic, and conversions.'],
    ],
    'benefits' => [
        'Sustainable organic traffic growth that doesn\'t depend on paid ads',
        'Higher visibility in AI Overviews and chat-based answer engines',
        'Stronger domain authority through structured, EEAT-aligned content',
        'Better qualified leads from intent-matched search traffic',
    ],
    'technologies' => ['Rank Math', 'Schema.org', 'Google Search Console', 'Core Web Vitals', 'LiteSpeed Cache'],
    'faqs' => [
        ['question' => 'How is AI search optimization different from traditional SEO?', 'answer' => 'AI search optimization focuses on structuring content so AI answer engines like ChatGPT, Gemini, and Perplexity can accurately extract and cite it, in addition to traditional ranking factors used by Google and Bing.'],
        ['question' => 'How long does it take to see SEO results?', 'answer' => 'Technical fixes can show impact within weeks, while content-driven ranking growth typically builds over 3-6 months and compounds from there.'],
        ['question' => 'Do you provide SEO reporting?', 'answer' => 'Yes, we provide monthly reports covering rankings, organic traffic, and conversions, along with a summary of work completed.'],
        ['question' => 'What is entity-based SEO?', 'answer' => 'Entity-based SEO structures content around real-world topics, people, and concepts (entities) that search engines and AI models already recognize, improving relevance and trust signals.'],
    ],
];

$meta = page_meta(
    'SEO Services | Technical, Semantic & AI Search Optimization | Muskiforge',
    'Muskiforge provides technical SEO, entity and semantic SEO, structured data, and AI citation optimization to grow organic visibility on Google, Bing, and AI search engines.',
    'services/seo-services.php'
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
