<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Blog | Insights on Software, SEO & Digital Growth | Muskiforge',
    'Read Muskiforge\'s insights on software development, SEO, cloud infrastructure, and digital growth for startups, SMEs, and enterprises.',
    'blog.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Blog', 'url' => url('blog.php')],
]);

try {
    $posts = db()->query(
        "SELECT title, slug, tag, excerpt, cover_image, published_at
         FROM blog_posts
         WHERE status = 'published'
         ORDER BY published_at DESC"
    )->fetchAll();
} catch (PDOException $e) {
    error_log('[blog] ' . $e->getMessage());
    $posts = [];
}

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Insights</span>
    <h1 class="section-title mt-2 mb-3">Muskiforge Blog</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      Practical, no-fluff writing on software development, SEO, cloud infrastructure, and digital growth.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <?php if (!$posts): ?>
    <div class="text-center mx-auto" style="max-width:480px">
      <p class="section-subtitle">No articles published yet — check back soon.</p>
    </div>
    <?php else: ?>
    <div class="row g-4">
      <?php foreach ($posts as $bi => $post): $av = accent_vars($bi); ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service bg-white p-0 overflow-hidden h-100">
          <a href="<?= e(url('blog-post.php?slug=' . $post['slug'])) ?>" class="text-decoration-none">
          <?php if ($post['cover_image']): ?>
          <img src="<?= e(url($post['cover_image'])) ?>" alt="<?= e($post['title']) ?>" class="w-100 d-block" style="height:200px;object-fit:cover" loading="lazy">
          <?php else: ?>
          <svg viewBox="0 0 400 200" class="w-100 d-block" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?= e($post['tag']) ?> article illustration">
            <defs>
              <linearGradient id="blogGrad<?= $bi ?>" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="<?= e($av['color']) ?>"/>
                <stop offset="100%" stop-color="<?= e($av['light']) ?>"/>
              </linearGradient>
            </defs>
            <rect width="400" height="200" fill="url(#blogGrad<?= $bi ?>)"/>
            <path d="M0 170 L100 130 L200 160 L300 110 L400 150 L400 200 L0 200 Z" fill="rgba(255,255,255,.18)"/>
            <circle cx="200" cy="90" r="40" fill="rgba(255,255,255,.22)"/>
            <foreignObject x="164" y="54" width="72" height="72">
              <div xmlns="http://www.w3.org/1999/xhtml" style="font-size:2.25rem;color:#fff;text-align:center;line-height:72px;">
                <i class="<?= e(blog_tag_icon($post['tag'])) ?>" aria-hidden="true"></i>
              </div>
            </foreignObject>
          </svg>
          <?php endif; ?>
          </a>
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="eyebrow"><?= e($post['tag']) ?></span>
              <span class="small text-muted"><?= e(date('M j, Y', strtotime((string) $post['published_at']))) ?></span>
            </div>
            <h2 class="h6 fw-bold mb-2"><?= e($post['title']) ?></h2>
            <p class="small text-muted mb-2"><?= e($post['excerpt']) ?></p>
            <a href="<?= e(url('blog-post.php?slug=' . $post['slug'])) ?>" class="fw-semibold service-card-link text-decoration-none">Read More <i class="fa-solid fa-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
