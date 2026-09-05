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
    if (trim(strip_tags($values['content'])) === '') {
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

$adminTitle = $existing ? 'Edit Post' : 'Add New Post';
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 fw-bold mb-0"><?= $existing ? 'Edit Post' : 'Add New Post' ?></h1>
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

<form method="post" enctype="multipart/form-data" id="postEditorForm">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php if ($existing): ?><input type="hidden" name="id" value="<?= (int) $existing['id'] ?>"><?php endif; ?>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="mb-3">
        <input type="text" id="title" name="title" class="form-control form-control-lg fw-semibold" required maxlength="200" placeholder="Add title" value="<?= e($values['title']) ?>">
      </div>
      <div class="mb-3">
        <div class="input-group input-group-sm" style="max-width:520px">
          <span class="input-group-text text-muted"><?= e(url('blog-post.php?slug=')) ?></span>
          <input type="text" id="slug" name="slug" class="form-control" maxlength="220" placeholder="auto-generated-from-title" value="<?= e($values['slug']) ?>">
        </div>
      </div>

      <div class="meta-box mb-4">
        <div class="meta-box-header">Content</div>
        <div class="meta-box-body p-0">
          <textarea id="content" name="content"><?= e($values['content']) ?></textarea>
        </div>
      </div>

      <div class="meta-box mb-4">
        <div class="meta-box-header">Excerpt</div>
        <div class="meta-box-body">
          <textarea id="excerpt" name="excerpt" class="form-control" rows="3" required maxlength="300"><?= e($values['excerpt']) ?></textarea>
          <div class="form-text">Shown on the blog listing and in search results.</div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="meta-box mb-3">
        <div class="meta-box-header">Publish</div>
        <div class="meta-box-body">
          <div class="mb-3">
            <label for="status" class="form-label small fw-semibold text-muted text-uppercase">Status</label>
            <select id="status" name="status" class="form-select">
              <option value="draft" <?= $values['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
              <option value="published" <?= $values['status'] === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
          </div>
          <button type="submit" id="publishBtn" class="btn btn-accent w-100 fw-semibold"></button>
        </div>
      </div>

      <div class="meta-box mb-3">
        <div class="meta-box-header">Tag</div>
        <div class="meta-box-body">
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
      </div>

      <div class="meta-box mb-3">
        <div class="meta-box-header">Featured Image</div>
        <div class="meta-box-body">
          <?php if ($currentCoverImage): ?>
          <div class="mb-2 position-relative">
            <img src="<?= e(url($currentCoverImage)) ?>" alt="Current cover image" class="img-fluid rounded-xl border">
            <div class="form-check mt-2">
              <input type="checkbox" class="form-check-input" id="removeCoverImage" name="remove_cover_image" value="1">
              <label class="form-check-label small" for="removeCoverImage">Remove this image</label>
            </div>
          </div>
          <?php else: ?>
          <p class="small text-muted mb-2">No image set — the blog listing will use a generated header instead.</p>
          <?php endif; ?>
          <input type="file" name="cover_image" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
          <div class="form-text">JPG, PNG, or WEBP. Max 5MB.</div>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.9/tinymce.min.js" referrerpolicy="origin"></script>
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

  // Publish/Save Draft/Update button label — mirrors WordPress, where the
  // primary action reflects the chosen status rather than a generic "Save".
  var statusEl = document.getElementById('status');
  var publishBtn = document.getElementById('publishBtn');
  var isExisting = <?= $existing ? 'true' : 'false' ?>;

  function updatePublishLabel() {
    if (isExisting) {
      publishBtn.textContent = 'Update';
    } else {
      publishBtn.textContent = statusEl.value === 'published' ? 'Publish' : 'Save Draft';
    }
  }
  statusEl.addEventListener('change', updatePublishLabel);
  updatePublishLabel();

  var csrfToken = document.querySelector('input[name="csrf_token"]').value;

  tinymce.init({
    selector: '#content',
    height: 520,
    menubar: false,
    plugins: 'lists link image table code blockquote wordcount',
    toolbar: 'undo redo | formatselect | bold italic | bullist numlist blockquote | link image | alignleft aligncenter alignright | code',
    content_style: "body { font-family: 'Geist', -apple-system, sans-serif; font-size: 15px; color: #0f172a; }",
    branding: false,
    images_upload_handler: function (blobInfo, progress) {
      return new Promise(function (resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= e(url("admin/upload-image.php")) ?>');
        xhr.upload.onprogress = function (e) { progress(e.loaded / e.total * 100); };
        xhr.onload = function () {
          if (xhr.status !== 200) { reject('Upload failed (HTTP ' + xhr.status + ')'); return; }
          var json;
          try { json = JSON.parse(xhr.responseText); } catch (e) { reject('Invalid server response'); return; }
          if (!json || !json.location) { reject(json && json.error ? json.error : 'Upload failed'); return; }
          resolve(json.location);
        };
        xhr.onerror = function () { reject('Upload failed — network error'); };
        var formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append('csrf_token', csrfToken);
        xhr.send(formData);
      });
    },
  });

  document.getElementById('postEditorForm').addEventListener('submit', function () {
    if (window.tinymce) tinymce.triggerSave();
  });
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
