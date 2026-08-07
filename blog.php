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

$posts = [
    ['Entity SEO in 2026: Building Topical Authority That AI Engines Cite', 'SEO', 'Aug 2, 2026', 'blog-1.jpg'],
    ['Choosing Between Laravel and Node.js for Your Next Platform', 'Software Development', 'Jul 24, 2026', 'blog-2.jpg'],
    ['Flutter vs Native: A Practical Guide for Startups', 'Mobile', 'Jul 12, 2026', 'blog-3.jpg'],
    ['Core Web Vitals: What Actually Moves the Needle in 2026', 'SEO', 'Jun 30, 2026', 'blog-4.jpg'],
    ['A Founder\'s Guide to Cloud Cost Optimization on AWS', 'Cloud', 'Jun 15, 2026', 'blog-5.jpg'],
    ['Structured Data 101: Schema Markup for AI Search Visibility', 'SEO', 'May 28, 2026', 'blog-6.jpg'],
];

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
    <div class="row g-4">
      <?php foreach ($posts as [$title, $tag, $date, $img]): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service bg-white p-0 overflow-hidden h-100">
          <img src="<?= e(asset('images/' . $img)) ?>" alt="<?= e($title) ?>" class="img-fluid w-100" loading="lazy">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="eyebrow"><?= e($tag) ?></span>
              <span class="small text-muted"><?= e($date) ?></span>
            </div>
            <h2 class="h6 fw-bold mb-2"><?= e($title) ?></h2>
            <a href="<?= e(url('blog.php')) ?>" class="fw-semibold text-accent text-decoration-none">Read More <i class="fa-solid fa-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
