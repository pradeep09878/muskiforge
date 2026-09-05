<?php

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

const POSTS_PER_PAGE = 20;

$statusFilter = in_array($_GET['status'] ?? '', ['published', 'draft'], true) ? $_GET['status'] : 'all';
$search = trim((string) ($_GET['s'] ?? ''));
$orderBy = ($_GET['orderby'] ?? '') === 'title' ? 'title' : 'date';
$order = ($_GET['order'] ?? '') === 'asc' ? 'asc' : 'desc';
$page = max(1, (int) ($_GET['paged'] ?? 1));

$dbError = null;
$posts = [];
$publishedCount = 0;
$draftCount = 0;
$totalPages = 1;

try {
    $publishedCount = (int) db()->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'published'")->fetchColumn();
    $draftCount = (int) db()->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'draft'")->fetchColumn();
    $totalCount = $publishedCount + $draftCount;

    $where = [];
    $params = [];
    if ($statusFilter !== 'all') {
        $where[] = 'p.status = :status';
        $params['status'] = $statusFilter;
    }
    if ($search !== '') {
        $where[] = 'p.title LIKE :search';
        $params['search'] = '%' . $search . '%';
    }
    $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

    $countStmt = db()->prepare("SELECT COUNT(*) FROM blog_posts p $whereSql");
    $countStmt->execute($params);
    $filteredCount = (int) $countStmt->fetchColumn();

    $totalPages = max(1, (int) ceil($filteredCount / POSTS_PER_PAGE));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * POSTS_PER_PAGE;

    $orderColumn = $orderBy === 'title' ? 'p.title' : 'p.updated_at';
    $orderSql = $orderColumn . ' ' . ($order === 'asc' ? 'ASC' : 'DESC');

    $stmt = db()->prepare(
        "SELECT p.id, p.title, p.slug, p.tag, p.status, p.cover_image, p.updated_at, p.published_at,
                a.username AS author_name
         FROM blog_posts p
         LEFT JOIN admins a ON a.id = p.author_id
         $whereSql
         ORDER BY $orderSql
         LIMIT " . POSTS_PER_PAGE . " OFFSET $offset"
    );
    $stmt->execute($params);
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('[admin-index] ' . $e->getMessage());
    $dbError = 'Could not load posts — the database may not be set up yet. Run database/schema.sql and try again.';
}

/** Builds an admin/index.php URL preserving every current filter except the overrides given. */
function admin_index_url(array $overrides = []): string
{
    $params = array_merge([
        'status' => $_GET['status'] ?? null,
        's' => $_GET['s'] ?? null,
        'orderby' => $_GET['orderby'] ?? null,
        'order' => $_GET['order'] ?? null,
        'paged' => $_GET['paged'] ?? null,
    ], $overrides);
    $params = array_filter($params, static fn ($v) => $v !== null && $v !== '' && $v !== 'all' && $v !== 1);

    return url('admin/index.php') . ($params ? '?' . http_build_query($params) : '');
}

$flash = flash_get();
$adminTitle = 'Blog Posts';
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

<?php if ($publishedCount + $draftCount > 0): ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
  <ul class="nav nav-pills gap-2 small mb-0">
    <li class="nav-item"><a class="nav-link<?= $statusFilter === 'all' ? ' active' : '' ?>" href="<?= e(admin_index_url(['status' => null, 'paged' => null])) ?>">All <span class="opacity-75">(<?= $publishedCount + $draftCount ?>)</span></a></li>
    <li class="nav-item"><a class="nav-link<?= $statusFilter === 'published' ? ' active' : '' ?>" href="<?= e(admin_index_url(['status' => 'published', 'paged' => null])) ?>">Published <span class="opacity-75">(<?= $publishedCount ?>)</span></a></li>
    <li class="nav-item"><a class="nav-link<?= $statusFilter === 'draft' ? ' active' : '' ?>" href="<?= e(admin_index_url(['status' => 'draft', 'paged' => null])) ?>">Draft <span class="opacity-75">(<?= $draftCount ?>)</span></a></li>
  </ul>
  <form method="get" action="<?= e(url('admin/index.php')) ?>" class="d-flex gap-2">
    <?php if ($statusFilter !== 'all'): ?><input type="hidden" name="status" value="<?= e($statusFilter) ?>"><?php endif; ?>
    <input type="search" name="s" class="form-control form-control-sm" placeholder="Search posts…" value="<?= e($search) ?>" style="width:220px">
    <button type="submit" class="btn btn-sm btn-outline-accent">Search</button>
    <?php if ($search !== ''): ?><a href="<?= e(admin_index_url(['s' => null, 'paged' => null])) ?>" class="btn btn-sm btn-outline-secondary">Clear</a><?php endif; ?>
  </form>
</div>
<?php endif; ?>

<?php if ($publishedCount + $draftCount === 0): ?>
<div class="bg-white rounded-xl p-5 text-center shadow-soft">
  <p class="section-subtitle mb-3">No blog posts yet.</p>
  <a href="<?= e(url('admin/post-edit.php')) ?>" class="btn btn-accent rounded-pill px-4">Write Your First Post</a>
</div>
<?php elseif (!$posts): ?>
<div class="bg-white rounded-xl p-5 text-center shadow-soft">
  <p class="section-subtitle mb-0">No posts match<?= $search !== '' ? ' "' . e($search) . '"' : ' this filter' ?>.</p>
</div>
<?php else: ?>
<form method="post" action="<?= e(url('admin/post-bulk.php')) ?>" id="postsForm">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

  <div class="d-flex align-items-center gap-2 mb-2">
    <select name="bulk_action" id="bulkActionSelect" class="form-select form-select-sm" style="width:auto">
      <option value="">Bulk actions</option>
      <option value="publish">Mark Published</option>
      <option value="draft">Mark Draft</option>
      <option value="delete">Delete</option>
    </select>
    <button type="submit" class="btn btn-sm btn-outline-secondary" onclick="return confirmBulkSubmit(event);">Apply</button>
  </div>

  <div class="bg-white rounded-xl shadow-soft overflow-hidden">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:36px"><input type="checkbox" class="form-check-input" id="selectAll"></th>
          <th style="width:56px"></th>
          <th>
            <a class="text-decoration-none text-reset" href="<?= e(admin_index_url(['orderby' => 'title', 'order' => $orderBy === 'title' && $order === 'asc' ? 'desc' : 'asc', 'paged' => null])) ?>">
              Title <?php if ($orderBy === 'title'): ?><i class="fa-solid fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?> small"></i><?php endif; ?>
            </a>
          </th>
          <th>Author</th>
          <th>Tag</th>
          <th>Status</th>
          <th>
            <a class="text-decoration-none text-reset" href="<?= e(admin_index_url(['orderby' => 'date', 'order' => $orderBy === 'date' && $order === 'asc' ? 'desc' : 'asc', 'paged' => null])) ?>">
              Last Updated <?php if ($orderBy === 'date'): ?><i class="fa-solid fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?> small"></i><?php endif; ?>
            </a>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
          <td><input type="checkbox" class="form-check-input post-checkbox" name="post[]" value="<?= (int) $post['id'] ?>"></td>
          <td>
            <?php if (!empty($post['cover_image'])): ?>
            <img src="<?= e(url($post['cover_image'])) ?>" alt="" class="rounded" style="width:40px;height:40px;object-fit:cover">
            <?php else: ?>
            <span class="d-flex align-items-center justify-content-center rounded bg-light text-muted" style="width:40px;height:40px"><i class="<?= e(blog_tag_icon($post['tag'])) ?>"></i></span>
            <?php endif; ?>
          </td>
          <td>
            <div class="fw-semibold"><?= e($post['title']) ?></div>
            <div class="row-actions small">
              <a href="<?= e(url('admin/post-edit.php?id=' . $post['id'])) ?>" class="text-decoration-none">Edit</a>
              <?php if ($post['status'] === 'published'): ?>
              <span class="text-muted"> | </span>
              <a href="<?= e(url('blog-post.php?slug=' . $post['slug'])) ?>" class="text-decoration-none" target="_blank" rel="noopener">View</a>
              <?php endif; ?>
              <span class="text-muted"> | </span>
              <a href="#" class="text-decoration-none text-danger" onclick="submitRowAction('delete', <?= (int) $post['id'] ?>); return false;">Delete</a>
            </div>
          </td>
          <td class="small text-muted"><?= e($post['author_name'] ?? '—') ?></td>
          <td><span class="badge text-bg-light border"><?= e($post['tag']) ?></span></td>
          <td>
            <?php if ($post['status'] === 'published'): ?>
            <span class="badge text-bg-success">Published</span>
            <?php else: ?>
            <span class="badge text-bg-secondary">Draft</span>
            <?php endif; ?>
          </td>
          <td class="small text-muted"><?= e(date('M j, Y g:ia', strtotime($post['updated_at']))) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</form>

<?php if ($totalPages > 1): ?>
<nav aria-label="Post pages" class="mt-3">
  <ul class="pagination pagination-sm justify-content-center mb-0">
    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
    <li class="page-item<?= $p === $page ? ' active' : '' ?>">
      <a class="page-link" href="<?= e(admin_index_url(['paged' => $p])) ?>"><?= $p ?></a>
    </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>
<?php endif; ?>

<script>
(function () {
  var selectAll = document.getElementById('selectAll');
  if (!selectAll) return;

  selectAll.addEventListener('change', function () {
    document.querySelectorAll('.post-checkbox').forEach(function (cb) { cb.checked = selectAll.checked; });
  });

  document.querySelectorAll('.post-checkbox').forEach(function (cb) {
    cb.addEventListener('change', function () {
      var all = document.querySelectorAll('.post-checkbox');
      var checked = document.querySelectorAll('.post-checkbox:checked');
      selectAll.checked = all.length > 0 && all.length === checked.length;
    });
  });

  window.submitRowAction = function (action, id) {
    if (action === 'delete' && !confirm('Delete this post? This cannot be undone.')) return;
    var form = document.getElementById('postsForm');
    document.querySelectorAll('.post-checkbox').forEach(function (cb) { cb.checked = (parseInt(cb.value, 10) === id); });
    document.getElementById('bulkActionSelect').value = action;
    form.submit();
  };

  window.confirmBulkSubmit = function (event) {
    var action = document.getElementById('bulkActionSelect').value;
    var checked = document.querySelectorAll('.post-checkbox:checked');
    if (!action || !checked.length) {
      alert('Select at least one post and a bulk action first.');
      event.preventDefault();
      return false;
    }
    if (action === 'delete' && !confirm('Delete ' + checked.length + ' post(s)? This cannot be undone.')) {
      event.preventDefault();
      return false;
    }
    return true;
  };
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
