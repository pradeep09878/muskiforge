<?php
/**
 * Dynamic XML sitemap. Served at /sitemap.php (referenced from robots.txt).
 * Point a rewrite rule at /sitemap.xml if a static-looking URL is preferred.
 */

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=UTF-8');

$staticPages = [
    ['path' => 'index.php', 'priority' => '1.0', 'changefreq' => 'weekly'],
    ['path' => 'about.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['path' => 'services.php', 'priority' => '0.9', 'changefreq' => 'monthly'],
    ['path' => 'portfolio.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['path' => 'industries.php', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ['path' => 'blog.php', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['path' => 'faq.php', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ['path' => 'contact.php', 'priority' => '0.8', 'changefreq' => 'yearly'],
    ['path' => 'privacy-policy.php', 'priority' => '0.3', 'changefreq' => 'yearly'],
    ['path' => 'terms.php', 'priority' => '0.3', 'changefreq' => 'yearly'],
];

foreach (array_keys(services_catalog()) as $slug) {
    $staticPages[] = ['path' => 'services/' . $slug . '.php', 'priority' => '0.9', 'changefreq' => 'monthly'];
}

// Degrade gracefully if the database isn't reachable or hasn't been
// migrated yet — the sitemap should still serve the static pages.
try {
    $blogPosts = db()->query(
        "SELECT slug, updated_at FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC"
    )->fetchAll();
} catch (PDOException $e) {
    $blogPosts = [];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($staticPages as $page): ?>
  <url>
    <loc><?= e(url($page['path'])) ?></loc>
    <changefreq><?= e($page['changefreq']) ?></changefreq>
    <priority><?= e($page['priority']) ?></priority>
  </url>
<?php endforeach; ?>
<?php foreach ($blogPosts as $post): ?>
  <url>
    <loc><?= e(url('blog-post.php?slug=' . $post['slug'])) ?></loc>
    <lastmod><?= e(date('Y-m-d', strtotime((string) $post['updated_at']))) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>
