<?php
/**
 * Schema.org JSON-LD generators. Each function returns a <script> tag
 * ready to echo into <head> or the end of <body>.
 */

declare(strict_types=1);

function schema_json(array $data): string
{
    return '<script type="application/ld+json">'
        . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>';
}

function schema_organization(): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => SITE_NAME,
        'url' => SITE_URL,
        'logo' => asset('images/logo.svg'),
        'description' => 'Muskiforge is an end-to-end IT services company providing website development, software development, mobile app development, cloud solutions, SEO services, digital marketing, and IT consulting.',
        'email' => SITE_EMAIL,
        'telephone' => SITE_PHONE,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => SITE_ADDRESS,
        ],
        'sameAs' => [
            SOCIAL_LINKEDIN,
            SOCIAL_TWITTER,
            SOCIAL_FACEBOOK,
            SOCIAL_INSTAGRAM,
            SOCIAL_GITHUB,
        ],
    ]);
}

function schema_website(): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => SITE_NAME,
        'url' => SITE_URL,
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => SITE_URL . '/search.php?q={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ]);
}

/**
 * @param array<int, array{question: string, answer: string}> $items
 */
function schema_faq(array $items): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(static fn (array $item) => [
            '@type' => 'Question',
            'name' => $item['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['answer'],
            ],
        ], $items),
    ]);
}

function schema_service(string $name, string $description, string $slug): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $name,
        'description' => $description,
        'url' => url('services/' . $slug . '.php'),
        'provider' => [
            '@type' => 'Organization',
            'name' => SITE_NAME,
            'url' => SITE_URL,
        ],
        'areaServed' => 'Worldwide',
    ]);
}

function schema_blog_posting(array $post): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post['title'],
        'description' => $post['excerpt'],
        'image' => $post['cover_image'] ? url($post['cover_image']) : asset('images/logo.svg'),
        'datePublished' => date('c', strtotime((string) $post['published_at'])),
        'dateModified' => date('c', strtotime((string) ($post['updated_at'] ?? $post['published_at']))),
        'author' => ['@type' => 'Organization', 'name' => SITE_NAME],
        'publisher' => [
            '@type' => 'Organization',
            'name' => SITE_NAME,
            'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo.svg')],
        ],
        'mainEntityOfPage' => url('blog-post.php?slug=' . $post['slug']),
    ]);
}

/**
 * @param array<int, array{name: string, url: string}> $trail
 */
function schema_breadcrumb(array $trail): string
{
    return schema_json([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_values(array_map(
            static fn (int $i, array $item) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ],
            array_keys($trail),
            $trail
        )),
    ]);
}
