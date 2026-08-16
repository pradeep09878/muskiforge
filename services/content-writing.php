<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'content-writing',
    'title' => 'Content Writing',
    'icon' => 'fa-solid fa-pen-nib',
    'heading' => 'Content That Reads Well and Ranks Well',
    'intro' => 'We write website copy, blog articles, and long-form content that engages real readers while giving Google, Bing, and AI answer engines the clear, well-structured material they need to rank and cite.',
    'features' => [
        ['icon' => 'fa-solid fa-file-lines', 'title' => 'Website Copy', 'text' => 'Clear, benefit-focused page copy for your homepage, service pages, and landing pages.'],
        ['icon' => 'fa-solid fa-newspaper', 'title' => 'Blog & Article Writing', 'text' => 'Regular, well-researched articles that build topical authority and keep your site fresh for search engines.'],
        ['icon' => 'fa-solid fa-diagram-project', 'title' => 'SEO Content Strategy', 'text' => 'Keyword and topic research that shapes what we write and when, tied to your actual growth goals.'],
        ['icon' => 'fa-solid fa-file-contract', 'title' => 'Case Studies & Whitepapers', 'text' => 'In-depth, credibility-building content for sales enablement and lead generation.'],
        ['icon' => 'fa-solid fa-spell-check', 'title' => 'Editing & Proofreading', 'text' => 'A second set of eyes on your existing content to sharpen clarity, tone, and accuracy.'],
        ['icon' => 'fa-solid fa-robot', 'title' => 'AI-Search Optimized Writing', 'text' => 'Content structured so AI answer engines like ChatGPT and Perplexity can accurately extract and cite it.'],
    ],
    'benefits' => [
        'Consistent publishing without hiring an in-house writing team',
        'Content that supports your SEO strategy instead of working against it',
        'A consistent brand voice across every page and article',
        'More qualified organic traffic from content built around real search intent',
    ],
    'technologies' => ['Surfer SEO', 'Google Search Console', 'Grammarly', 'Ahrefs', 'Google Docs'],
    'faqs' => [
        ['question' => 'Do you write content for our industry specifically?', 'answer' => 'Yes, our writers research your industry, audience, and competitors before writing, so content reflects real expertise rather than generic filler.'],
        ['question' => 'How many articles or pages can you deliver per month?', 'answer' => "Volume depends on scope and depth — we'll agree on a realistic monthly cadence during onboarding, whether that's a handful of in-depth articles or a larger volume of shorter pieces."],
        ['question' => 'Do you handle keyword research too?', 'answer' => 'Yes, content writing is paired with keyword and topic research so what we write is aligned with actual search demand, not guesswork.'],
        ['question' => 'Can you match our existing brand voice?', 'answer' => "Yes, we start every engagement by reviewing your existing content and style guidelines (or helping you build one) so new content sounds consistent with what's already published."],
    ],
];

$meta = page_meta(
    'Content Writing Services | SEO-Ready Website & Blog Content | Muskiforge',
    'Muskiforge provides content writing services — website copy, blog articles, case studies, and AI-search optimized content written to engage readers and rank in search.',
    'services/content-writing.php'
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
