<?php

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

const MAX_COVER_BYTES = 5 * 1024 * 1024;
const ALLOWED_COVER_TYPES = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

$postId = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$existing = null;

if ($postId) {
    try {
        $stmt = db()->prepare('SELECT * FROM blog_posts WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $postId]);
        $existing = $stmt->fetch() ?: null;
    } catch (PDOException $e) {
        error_log('[admin-post-edit] ' . $e->getMessage());
        flash_set('error', 'Could not load that post — the database may be unavailable.');
        header('Location: ' . url('admin/index.php'));
        exit;
    }

    if (!$existing) {
        flash_set('error', 'That post no longer exists.');
        header('Location: ' . url('admin/index.php'));
        exit;
    }
}

$errors = [];
$values = [
    'title' => $existing['title'] ?? '',
    'slug' => $existing['slug'] ?? '',
    'tag' => $existing['tag'] ?? 'General',
    'excerpt' => $existing['excerpt'] ?? '',
    'content' => $existing['content'] ?? '',
    'status' => $existing['status'] ?? 'draft',
];
$currentCoverImage = $existing['cover_image'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired. Please try again.';
    }

    $values['title'] = trim((string) ($_POST['title'] ?? ''));
    $values['slug'] = slugify((string) ($_POST['slug'] ?? '') ?: $values['title']);
    $values['tag'] = trim((string) ($_POST['tag'] ?? '')) ?: 'General';
    $values['excerpt'] = trim((string) ($_POST['excerpt'] ?? ''));
    $values['content'] = trim((string) ($_POST['content'] ?? ''));
    $values['status'] = ($_POST['status'] ?? 'draft') === 'published' ? 'published' : 'draft';

    if ($values['title'] === '' || mb_strlen($values['title']) > 200) {
        $errors[] = 'Title is required (max 200 characters).';
    }
    if ($values['slug'] === '') {
        $errors[] = 'Slug could not be generated — please enter a title or custom slug using letters and numbers.';
    }
    if ($values['excerpt'] === '' || mb_strlen($values['excerpt']) > 300) {
        $errors[] = 'Excerpt is required (max 300 characters).';
    }
    if ($values['content'] === '') {
        $errors[] = 'Content is required.';
    }

    if ($values['slug'] !== '' && !$errors) {
        try {
            $dupe = db()->prepare('SELECT id FROM blog_posts WHERE slug = :slug AND id != :id LIMIT 1');
            $dupe->execute(['slug' => $values['slug'], 'id' => $postId ?? 0]);
            if ($dupe->fetch()) {
                $errors[] = "The slug \"{$values['slug']}\" is already used by another post. Choose a different one.";
            }
        } catch (PDOException $e) {
            error_log('[admin-post-edit] ' . $e->getMessage());
            $errors[] = 'Something went wrong checking the URL slug. Please try again.';
        }
    }

    $newCoverImage = $currentCoverImage;

    if (!empty($_POST['remove_cover_image'])) {
        $newCoverImage = null;
    }

    if (!$errors && !empty($_FILES['cover_image']['name'])) {
        $file = $_FILES['cover_image'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'The cover image failed to upload. Please try again.';
        } elseif ($file['size'] > MAX_COVER_BYTES) {
            $errors[] = 'Cover image must be 5MB or smaller.';
        } else {
            $mimeType = mime_content_type($file['tmp_name']) ?: '';
            $extension = ALLOWED_COVER_TYPES[$mimeType] ?? null;

            if (!$extension) {
                $errors[] = 'Cover image must be a JPG, PNG, or WEBP file.';
            } else {
                $uploadDir = __DIR__ . '/../uploads/blog';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $filename = $values['slug'] . '-' . time() . '.' . $extension;
                if (move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $filename)) {
                    $newCoverImage = 'uploads/blog/' . $filename;
                } else {
                    $errors[] = 'The cover image could not be saved. Please try again.';
                }
            }
        }
    }

    if (!$errors) {
        $publishedAt = $existing['published_at'] ?? null;
        if ($values['status'] === 'published' && !$publishedAt) {
            $publishedAt = date('Y-m-d H:i:s');
        }

        try {
            if ($existing) {
                $stmt = db()->prepare(
                    'UPDATE blog_posts
                     SET title = :title, slug = :slug, tag = :tag, excerpt = :excerpt, content = :content,
                         cover_image = :cover_image, status = :status, published_at = :published_at
                     WHERE id = :id'
                );
                $stmt->execute([
                    'title' => $values['title'],
                    'slug' => $values['slug'],
                    'tag' => $values['tag'],
                    'excerpt' => $values['excerpt'],
                    'content' => $values['content'],
                    'cover_image' => $newCoverImage,
                    'status' => $values['status'],
                    'published_at' => $publishedAt,
                    'id' => $existing['id'],
                ]);
            } else {
                $stmt = db()->prepare(
                    'INSERT INTO blog_posts (title, slug, tag, excerpt, content, cover_image, status, published_at, author_id)
                     VALUES (:title, :slug, :tag, :excerpt, :content, :cover_image, :status, :published_at, :author_id)'
                );
                $stmt->execute([
                    'title' => $values['title'],
                    'slug' => $values['slug'],
                    'tag' => $values['tag'],
                    'excerpt' => $values['excerpt'],
                    'content' => $values['content'],
                    'cover_image' => $newCoverImage,
                    'status' => $values['status'],
                    'published_at' => $publishedAt,
                    'author_id' => $_SESSION['admin_id'],
                ]);
            }

            flash_set('success', $existing ? 'Post updated.' : 'Post created.');
            header('Location: ' . url('admin/index.php'));
            exit;
        } catch (PDOException $e) {
            error_log('[admin-post-edit] ' . $e->getMessage());
            $errors[] = 'Something went wrong saving the post. Please try again.';
        }
    }

    // Re-fetch failed: keep the uploaded/removed image state visible on redisplay.
    $currentCoverImage = $newCoverImage;
}

$adminTitle = $existing ? 'Edit Post' : 'New Post';
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold mb-0"><?= $existing ? 'Edit Post' : 'New Post' ?></h1>
  <a href="<?= e(url('admin/index.php')) ?>" class="small text-decoration-none">&larr; Back to all posts</a>
</div>

<?php if ($errors): ?>
<div class="alert alert-danger">
  <ul class="mb-0 ps-3">
    <?php foreach ($errors as $error): ?>
    <li><?= e($error) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="bg-white rounded-xl shadow-soft p-4">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php if ($existing): ?><input type="hidden" name="id" value="<?= (int) $existing['id'] ?>"><?php endif; ?>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="mb-3">
        <label for="title" class="form-label fw-semibold">Title</label>
        <input type="text" id="title" name="title" class="form-control" required maxlength="200" value="<?= e($values['title']) ?>">
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label fw-semibold">URL Slug</label>
        <div class="input-group">
          <span class="input-group-text small text-muted"><?= e(url('blog-post.php?slug=')) ?></span>
          <input type="text" id="slug" name="slug" class="form-control" maxlength="220" placeholder="auto-generated-from-title" value="<?= e($values['slug']) ?>">
        </div>
      </div>
      <div class="mb-3">
        <label for="excerpt" class="form-label fw-semibold">Excerpt <span class="text-muted fw-normal">(shown on the blog listing)</span></label>
        <textarea id="excerpt" name="excerpt" class="form-control" rows="2" required maxlength="300"><?= e($values['excerpt']) ?></textarea>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label fw-semibold">Content</label>
        <textarea id="content" name="content" class="form-control" rows="16" required><?= e($values['content']) ?></textarea>
        <div class="form-text">Plain text. Leave a blank line between paragraphs.</div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="mb-3">
        <label for="tag" class="form-label fw-semibold">Tag</label>
        <input type="text" id="tag" name="tag" class="form-control" list="tagOptions" value="<?= e($values['tag']) ?>">
        <datalist id="tagOptions">
          <option value="SEO">
          <option value="Software Development">
          <option value="Mobile">
          <option value="Cloud">
          <option value="Digital Marketing">
          <option value="IT Consulting">
          <option value="Web Development">
          <option value="General">
        </datalist>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Cover Image <span class="text-muted fw-normal">(optional)</span></label>
        <?php if ($currentCoverImage): ?>
        <div class="mb-2 position-relative">
          <img src="<?= e(url($currentCoverImage)) ?>" alt="Current cover image" class="img-fluid rounded-xl border">
          <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="removeCoverImage" name="remove_cover_image" value="1">
            <label class="form-check-label small" for="removeCoverImage">Remove this image</label>
          </div>
        </div>
        <?php else: ?>
        <p class="small text-muted mb-2">No image uploaded — the blog listing will use a generated header instead.</p>
        <?php endif; ?>
        <input type="file" name="cover_image" class="form-control" accept="image/jpeg,image/png,image/webp">
        <div class="form-text">JPG, PNG, or WEBP. Max 5MB.</div>
      </div>

      <div class="mb-4">
        <label for="status" class="form-label fw-semibold">Status</label>
        <select id="status" name="status" class="form-select">
          <option value="draft" <?= $values['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
          <option value="published" <?= $values['status'] === 'published' ? 'selected' : '' ?>>Published</option>
        </select>
      </div>

      <button type="submit" class="btn btn-accent w-100 fw-semibold"><?= $existing ? 'Save Changes' : 'Create Post' ?></button>
    </div>
  </div>
</form>

<script>
(function () {
  var titleEl = document.getElementById('title');
  var slugEl = document.getElementById('slug');
  var slugTouched = <?= $existing ? 'true' : 'false' ?>;

  slugEl.addEventListener('input', function () { slugTouched = true; });

  titleEl.addEventListener('input', function () {
    if (slugTouched) return;
    slugEl.value = titleEl.value
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-+|-+$/g, '');
  });
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
