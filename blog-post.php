<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$slug = trim((string) ($_GET['slug'] ?? ''));
$post = null;

try {
    $stmt = db()->prepare(
        "SELECT * FROM blog_posts WHERE slug = :slug AND status = 'published' LIMIT 1"
    );
    $stmt->execute(['slug' => $slug]);
    $post = $stmt->fetch() ?: null;
} catch (PDOException $e) {
    error_log('[blog-post] ' . $e->getMessage());
}

if (!$post) {
    http_response_code(404);
    $meta = page_meta('Article Not Found | Muskiforge', 'This article could not be found.', 'blog-post.php');
    require __DIR__ . '/includes/header.php';
    ?>
    <main id="main-content">
      <section class="py-5 text-center">
        <div class="container">
          <h1 class="section-title mb-3">Article Not Found</h1>
          <p class="section-subtitle mx-auto mb-4">This article may have been unpublished or the link is incorrect.</p>
          <a href="<?= e(url('blog.php')) ?>" class="btn btn-accent rounded-pill px-4">Back to Blog</a>
        </div>
      </section>
    </main>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$meta = page_meta(
    $post['title'] . ' | Muskiforge Blog',
    $post['excerpt'],
    'blog-post.php?slug=' . $post['slug']
);

$extraSchema = schema_blog_posting($post) . schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Blog', 'url' => url('blog.php')],
    ['name' => $post['title'], 'url' => url('blog-post.php?slug=' . $post['slug'])],
]);

$tv = tonal_vars((int) crc32($post['slug']));

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<article>
  <section class="py-5">
    <div class="container" style="max-width:820px">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small mb-0">
          <li class="breadcrumb-item"><a href="<?= e(url('blog.php')) ?>" class="text-decoration-none">Blog</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= e($post['tag']) ?></li>
        </ol>
      </nav>
      <span class="eyebrow"><?= e($post['tag']) ?></span>
      <h1 class="section-title mt-2 mb-3"><?= e($post['title']) ?></h1>
      <p class="text-muted mb-4"><?= e(date('F j, Y', strtotime((string) $post['published_at']))) ?></p>

      <?php if ($post['cover_image']): ?>
      <img src="<?= e(url($post['cover_image'])) ?>" alt="<?= e($post['title']) ?>" class="img-fluid rounded-xl shadow-soft w-100 mb-4" style="max-height:420px;object-fit:cover">
      <?php else: ?>
      <div class="blog-block rounded-xl shadow-soft w-100 mb-4" style="height:280px;background:<?= e($tv['bg']) ?>;color:<?= e($tv['fg']) ?>">
        <i class="<?= e(blog_tag_icon($post['tag'])) ?> blog-block-icon" style="font-size:3rem" aria-hidden="true"></i>
        <span class="blog-block-tag"><?= e($post['tag']) ?></span>
      </div>
      <?php endif; ?>

      <div class="fs-5" style="color:var(--mf-text-muted);line-height:1.8">
        <?= render_plain_content($post['content']) ?>
      </div>

      <hr class="my-5">
      <a href="<?= e(url('blog.php')) ?>" class="fw-semibold service-card-link text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i> Back to all articles</a>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <div class="cta-section text-center px-4 py-5">
        <h2 class="mb-3" style="font-weight:800">Have a Project in Mind?</h2>
        <p class="mb-4 mx-auto" style="max-width:520px;opacity:.9">Let's talk about how Muskiforge can help you build it.</p>
        <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Start a Conversation</a>
      </div>
    </div>
  </section>
</article>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
