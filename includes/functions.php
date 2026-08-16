<?php
/**
 * Shared helper functions used across the site.
 */

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Cycles through the accent color palette for repeating card/icon grids
 * (services, differentiators, process steps) so they don't all read as one
 * flat blue. Returns an icon-badge modifier class; empty string = default blue.
 */
function accent_class(int $index): string
{
    $palette = ['', 'accent-violet', 'accent-emerald', 'accent-amber', 'accent-rose', 'accent-indigo'];

    return $palette[$index % count($palette)];
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
            'summary' => 'Professional, responsive, and SEO-optimized websites built to convert visitors into customers.',
            'description' => 'We design and build custom websites that combine clean UX, semantic HTML5, and Core Web Vitals performance out of the box — from marketing sites to complex web portals.',
        ],
        'software-development' => [
            'title' => 'Software Development',
            'icon' => 'fa-solid fa-code',
            'summary' => 'Custom software engineered to automate workflows, improve productivity, and support long-term business growth.',
            'description' => 'Our engineering team ships custom web applications, internal tools, and SaaS platforms using PHP, Laravel, and Node.js with an emphasis on maintainability and security.',
        ],
        'mobile-app-development' => [
            'title' => 'Mobile App Development',
            'icon' => 'fa-solid fa-mobile-screen-button',
            'summary' => 'Android, iOS, and cross-platform applications designed with performance, security, and user experience in mind.',
            'description' => 'From Flutter cross-platform builds to native Kotlin and Swift apps, we deliver mobile experiences that perform well and ship on schedule.',
        ],
        'cloud-solutions' => [
            'title' => 'Cloud Solutions',
            'icon' => 'fa-solid fa-cloud',
            'summary' => 'Cloud migration, infrastructure management, security, deployment, and scalable cloud architecture tailored to modern businesses.',
            'description' => 'We design resilient, cost-efficient cloud infrastructure and manage migrations, CI/CD pipelines, and container orchestration for growing businesses.',
        ],
        'digital-marketing' => [
            'title' => 'Digital Marketing',
            'icon' => 'fa-solid fa-bullhorn',
            'summary' => 'Data-driven digital marketing strategies that increase visibility, generate qualified leads, and improve return on investment.',
            'description' => 'We plan and run digital marketing programs spanning content strategy, paid media, social, and email to turn traffic into pipeline.',
        ],
        'seo-services' => [
            'title' => 'SEO Services',
            'icon' => 'fa-solid fa-magnifying-glass-chart',
            'summary' => 'Search engine optimization focused on sustainable organic growth through technical SEO, content strategy, local SEO, and on-page optimization.',
            'description' => 'Our SEO practice covers technical audits, entity and semantic SEO, structured data, and AI citation optimization for Google, Bing, and AI answer engines.',
        ],
        'it-consulting' => [
            'title' => 'IT Consulting',
            'icon' => 'fa-solid fa-lightbulb',
            'summary' => 'Technology consulting that helps businesses choose the right infrastructure, software, cloud strategy, and digital roadmap.',
            'description' => 'Our consultants help leadership teams make sound technology decisions — architecture reviews, vendor selection, security posture, and digital transformation roadmaps.',
        ],
    ];
}

/**
 * The six-stage delivery process, shared by the homepage and every
 * individual service page so the story stays consistent site-wide.
 */
function process_steps(): array
{
    return [
        ['title' => 'Discover', 'desc' => 'Understanding your business objectives and technical requirements.'],
        ['title' => 'Plan', 'desc' => 'Creating a clear roadmap with timelines and milestones.'],
        ['title' => 'Design', 'desc' => 'Building intuitive user experiences and modern interfaces.'],
        ['title' => 'Develop', 'desc' => 'Writing secure, scalable, and maintainable code.'],
        ['title' => 'Test', 'desc' => 'Ensuring quality through rigorous testing and optimization.'],
        ['title' => 'Launch & Support', 'desc' => 'Deploying your solution and providing continuous maintenance.'],
    ];
}

/**
 * Industries served, shared by the homepage industries grid.
 */
function industries_served(): array
{
    return [
        ['name' => 'Healthcare', 'icon' => 'fa-solid fa-heart-pulse'],
        ['name' => 'Manufacturing', 'icon' => 'fa-solid fa-industry'],
        ['name' => 'Logistics & Supply Chain', 'icon' => 'fa-solid fa-truck-fast'],
        ['name' => 'Retail & E-commerce', 'icon' => 'fa-solid fa-cart-shopping'],
        ['name' => 'Finance', 'icon' => 'fa-solid fa-chart-line'],
        ['name' => 'Education', 'icon' => 'fa-solid fa-graduation-cap'],
        ['name' => 'Real Estate', 'icon' => 'fa-solid fa-building'],
        ['name' => 'Hospitality', 'icon' => 'fa-solid fa-bell-concierge'],
        ['name' => 'Startups', 'icon' => 'fa-solid fa-rocket'],
        ['name' => 'Professional Services', 'icon' => 'fa-solid fa-briefcase'],
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
