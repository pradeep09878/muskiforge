<?php
/**
 * Shared helper functions used across the site.
 */

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function asset(string $path): string
{
    return SITE_URL . '/assets/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    return SITE_URL . '/' . ltrim($path, '/');
}

function current_page(): string
{
    return basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: 'index.php');
}

function nav_active(string $page): string
{
    return current_page() === $page ? ' active' : '';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_verify(?string $token): bool
{
    return is_string($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Services catalog: single source of truth for nav, homepage cards,
 * the services overview page, and the individual service pages.
 */
function services_catalog(): array
{
    return [
        'website-development' => [
            'title' => 'Website Development',
            'icon' => 'fa-solid fa-globe',
            'summary' => 'Fast, responsive, SEO-ready websites built on modern standards.',
            'description' => 'We design and build custom websites that combine clean UX, semantic HTML5, and Core Web Vitals performance out of the box — from marketing sites to complex web portals.',
        ],
        'software-development' => [
            'title' => 'Software Development',
            'icon' => 'fa-solid fa-code',
            'summary' => 'Custom software engineered around your business logic, not the other way around.',
            'description' => 'Our engineering team ships custom web applications, internal tools, and SaaS platforms using PHP, Laravel, and Node.js with an emphasis on maintainability and security.',
        ],
        'mobile-app-development' => [
            'title' => 'Mobile App Development',
            'icon' => 'fa-solid fa-mobile-screen-button',
            'summary' => 'Native and cross-platform apps for iOS and Android.',
            'description' => 'From Flutter cross-platform builds to native Kotlin and Swift apps, we deliver mobile experiences that perform well and ship on schedule.',
        ],
        'cloud-solutions' => [
            'title' => 'Cloud Solutions',
            'icon' => 'fa-solid fa-cloud',
            'summary' => 'Cloud architecture, migration, and DevOps on AWS, Azure, and GCP.',
            'description' => 'We design resilient, cost-efficient cloud infrastructure and manage migrations, CI/CD pipelines, and container orchestration for growing businesses.',
        ],
        'seo-services' => [
            'title' => 'SEO Services',
            'icon' => 'fa-solid fa-magnifying-glass-chart',
            'summary' => 'Technical, on-page, and AI-search optimization that compounds over time.',
            'description' => 'Our SEO practice covers technical audits, entity and semantic SEO, structured data, and AI citation optimization for Google, Bing, and AI answer engines.',
        ],
        'digital-marketing' => [
            'title' => 'Digital Marketing',
            'icon' => 'fa-solid fa-bullhorn',
            'summary' => 'Full-funnel marketing across search, social, and paid channels.',
            'description' => 'We plan and run digital marketing programs spanning content strategy, paid media, social, and email to turn traffic into pipeline.',
        ],
        'it-consulting' => [
            'title' => 'IT Consulting',
            'icon' => 'fa-solid fa-lightbulb',
            'summary' => 'Strategic technology guidance for businesses navigating growth.',
            'description' => 'Our consultants help leadership teams make sound technology decisions — architecture reviews, vendor selection, security posture, and digital transformation roadmaps.',
        ],
    ];
}

function page_meta(string $title, string $description, string $canonicalPath = ''): array
{
    return [
        'title' => $title,
        'description' => $description,
        'canonical' => url($canonicalPath),
    ];
}
