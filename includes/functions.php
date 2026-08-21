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
 * One confident brand color, not a rainbow — kept as a function (rather
 * than inlining "") so call sites don't need touching if this changes again.
 */
function accent_class(int $index): string
{
    return '';
}

/**
 * Tonal cycle within the single brand color (light tint / solid / dark navy)
 * for repeating color-block treatments (portfolio, blog) — variety through
 * value, not hue, so it stays premium rather than a rainbow of accents.
 */
function tonal_vars(int $index): array
{
    $palette = [
        ['bg' => 'var(--mf-accent)', 'fg' => '#ffffff'],
        ['bg' => 'var(--mf-dark)', 'fg' => '#ffffff'],
        ['bg' => 'var(--mf-accent-light)', 'fg' => 'var(--mf-navy)'],
    ];

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

/**
 * One-shot flash messages for post-redirect confirmations (e.g. "Post
 * created"). Set before a redirect, read (and cleared) on the next request.
 */
function flash_set(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
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
        'content-writing' => [
            'title' => 'Content Writing',
            'icon' => 'fa-solid fa-pen-nib',
            'summary' => 'Clear, conversion-focused website copy, blog articles, and product content written to engage readers and rank in search.',
            'description' => 'Our writers produce website copy, blog articles, case studies, and product content that reads naturally for people while giving search engines and AI answer engines the structured, well-researched material they need to rank and cite.',
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

/**
 * Homepage hero carousel slides — edit copy, CTAs, or add/remove slides
 * here without touching the carousel markup in index.php. 'art' selects
 * which decorative visual variant renders (see .hero-slide-art--* in
 * style.css): network | glass | shield.
 */
function hero_slides(): array
{
    return [
        [
            'eyebrow' => 'IT Services & Digital Solutions',
            'title' => 'Powering Businesses with Smarter IT Solutions',
            'text' => 'We design, build and manage secure, scalable technology solutions that help businesses operate faster, smarter and more efficiently.',
            'primary' => ['label' => 'Explore Our Services', 'url' => 'services.php'],
            'secondary' => ['label' => 'Talk to an Expert', 'url' => 'contact.php'],
            'art' => 'network',
        ],
        [
            'eyebrow' => 'Software & Digital Transformation',
            'title' => 'Transform Ideas Into Powerful Digital Products',
            'text' => 'From custom software and web applications to enterprise platforms, we build technology that solves real business problems.',
            'primary' => ['label' => 'View Our Solutions', 'url' => 'services.php'],
            'secondary' => ['label' => 'Start Your Project', 'url' => 'contact.php'],
            'art' => 'glass',
        ],
        [
            'eyebrow' => 'Cloud, Security & Infrastructure',
            'title' => 'Secure. Scalable. Always Ready.',
            'text' => 'Build a resilient technology foundation with cloud infrastructure, cybersecurity, DevOps and managed IT services.',
            'primary' => ['label' => 'Discover Our Solutions', 'url' => 'services.php'],
            'secondary' => ['label' => 'Get a Free Consultation', 'url' => 'contact.php'],
            'art' => 'shield',
        ],
    ];
}

/**
 * Converts arbitrary text into a URL-safe slug: lowercase, alphanumeric,
 * words joined with single hyphens. Used for blog post URLs.
 */
function slugify(string $text): string
{
    $slug = strtolower(trim($text));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';

    return trim($slug, '-');
}

/**
 * Icon shown on a blog post's generated header when no cover image was
 * uploaded. Falls back to a generic document icon for unrecognized tags.
 */
function blog_tag_icon(string $tag): string
{
    $icons = [
        'SEO' => 'fa-solid fa-magnifying-glass-chart',
        'Software Development' => 'fa-solid fa-code',
        'Mobile' => 'fa-solid fa-mobile-screen-button',
        'Cloud' => 'fa-solid fa-cloud',
        'Digital Marketing' => 'fa-solid fa-bullhorn',
        'IT Consulting' => 'fa-solid fa-lightbulb',
        'Web Development' => 'fa-solid fa-globe',
        'General' => 'fa-solid fa-newspaper',
    ];

    return $icons[$tag] ?? 'fa-solid fa-newspaper';
}

/**
 * Renders plain-text blog content (blank line = new paragraph) as safe,
 * escaped HTML. No raw HTML is ever trusted from the content field.
 */
function render_plain_content(string $content): string
{
    $paragraphs = preg_split('/\n\s*\n/', trim($content)) ?: [];
    $html = '';

    foreach ($paragraphs as $paragraph) {
        $paragraph = trim($paragraph);
        if ($paragraph === '') {
            continue;
        }
        $html .= '<p>' . nl2br(e($paragraph)) . "</p>\n";
    }

    return $html;
}

function page_meta(string $title, string $description, string $canonicalPath = ''): array
{
    return [
        'title' => $title,
        'description' => $description,
        'canonical' => url($canonicalPath),
    ];
}
