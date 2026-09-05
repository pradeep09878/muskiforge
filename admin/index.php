<?php

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

$dbError = null;
try {
    $posts = db()->query(
        'SELECT id, title, slug, tag, status, published_at, updated_at
         FROM blog_posts
         ORDER BY created_at DESC'
    )->fetchAll();
} catch (PDOException $e) {
    error_log('[admin-index] ' . $e->getMessage());
    $posts = [];
    $dbError = 'Could not load posts — the database may not be set up yet. Run database/schema.sql and try again.';
}

$flash = flash_get();
$adminTitle = 'Blog Posts';

$statusFilter = in_array($_GET['status'] ?? '', ['published', 'draft'], true) ? $_GET['status'] : 'all';
$publishedCount = count(array_filter($posts, static fn (array $p): bool => $p['status'] === 'published'));
$draftCount = count($posts) - $publishedCount;
$visiblePosts = $statusFilter === 'all' ? $posts : array_values(array_filter($posts, static fn (array $p): bool => $p['status'] === $statusFilter));

require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 fw-bold mb-0">Blog Posts</h1>
  <a href="<?= e(url('admin/post-edit.php')) ?>" class="btn btn-accent rounded-pill px-3"><i class="fa-solid fa-plus me-1"></i>Add New</a>
</div>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?> py-2"><?= e($flash['message']) ?></div>
<?php endif; ?>

<?php if ($dbError): ?>
<div class="alert alert-warning py-2"><?= e($dbError) ?></div>
<?php endif; ?>

<?php if ($posts): ?>
<ul class="nav nav-pills gap-2 mb-3 small">
  <li class="nav-item"><a class="nav-link<?= $statusFilter === 'all' ? ' active' : '' ?>" href="<?= e(url('admin/index.php')) ?>">All <span class="opacity-75">(<?= count($posts) ?>)</span></a></li>
  <li class="nav-item"><a class="nav-link<?= $statusFilter === 'published' ? ' active' : '' ?>" href="<?= e(url('admin/index.php?status=published')) ?>">Published <span class="opacity-75">(<?= $publishedCount ?>)</span></a></li>
  <li class="nav-item"><a class="nav-link<?= $statusFilter === 'draft' ? ' active' : '' ?>" href="<?= e(url('admin/index.php?status=draft')) ?>">Draft <span class="opacity-75">(<?= $draftCount ?>)</span></a></li>
</ul>
<?php endif; ?>

<?php if (!$posts): ?>
<div class="bg-white rounded-xl p-5 text-center shadow-soft">
  <p class="section-subtitle mb-3">No blog posts yet.</p>
  <a href="<?= e(url('admin/post-edit.php')) ?>" class="btn btn-accent rounded-pill px-4">Write Your First Post</a>
</div>
<?php elseif (!$visiblePosts): ?>
<div class="bg-white rounded-xl p-5 text-center shadow-soft">
  <p class="section-subtitle mb-0">No posts in this filter.</p>
</div>
<?php else: ?>
<div class="bg-white rounded-xl shadow-soft overflow-hidden">
  <table class="table table-hover align-middle mb-0">
    <thead class="table-light">
      <tr>
        <th style="width:56px"></th>
        <th>Title</th>
        <th>Tag</th>
        <th>Status</th>
        <th>Last Updated</th>
        <th class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($visiblePosts as $post): ?>
      <tr>
        <td>
          <?php if (!empty($post['cover_image'])): ?>
          <img src="<?= e(url($post['cover_image'])) ?>" alt="" class="rounded" style="width:40px;height:40px;object-fit:cover">
          <?php else: ?>
          <span class="d-flex align-items-center justify-content-center rounded bg-light text-muted" style="width:40px;height:40px"><i class="<?= e(blog_tag_icon($post['tag'])) ?>"></i></span>
          <?php endif; ?>
        </td>
        <td class="fw-semibold"><?= e($post['title']) ?></td>
        <td><span class="badge text-bg-light border"><?= e($post['tag']) ?></span></td>
        <td>
          <?php if ($post['status'] === 'published'): ?>
          <span class="badge text-bg-success">Published</span>
          <?php else: ?>
          <span class="badge text-bg-secondary">Draft</span>
          <?php endif; ?>
        </td>
        <td class="small text-muted"><?= e(date('M j, Y g:ia', strtotime($post['updated_at']))) ?></td>
        <td class="text-end">
          <?php if ($post['status'] === 'published'): ?>
          <a href="<?= e(url('blog-post.php?slug=' . $post['slug'])) ?>" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener" title="View live"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
          <?php endif; ?>
          <a href="<?= e(url('admin/post-edit.php?id=' . $post['id'])) ?>" class="btn btn-sm btn-outline-accent">Edit</a>
          <form action="<?= e(url('admin/post-delete.php')) ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this post? This cannot be undone.');">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="id" value="<?= (int) $post['id'] ?>">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
