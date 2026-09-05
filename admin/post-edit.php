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
    'cover_image_alt' => $existing['cover_image_alt'] ?? '',
    'meta_title' => $existing['meta_title'] ?? '',
    'meta_description' => $existing['meta_description'] ?? '',
    'focus_keyword' => $existing['focus_keyword'] ?? '',
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
    $values['cover_image_alt'] = trim((string) ($_POST['cover_image_alt'] ?? ''));
    $values['meta_title'] = trim((string) ($_POST['meta_title'] ?? ''));
    $values['meta_description'] = trim((string) ($_POST['meta_description'] ?? ''));
    $values['focus_keyword'] = trim((string) ($_POST['focus_keyword'] ?? ''));

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
    if (mb_strlen($values['meta_title']) > 200) {
        $errors[] = 'SEO title must be 200 characters or fewer.';
    }
    if (mb_strlen($values['meta_description']) > 300) {
        $errors[] = 'Meta description must be 300 characters or fewer.';
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
                         cover_image = :cover_image, cover_image_alt = :cover_image_alt, status = :status,
                         published_at = :published_at, meta_title = :meta_title,
                         meta_description = :meta_description, focus_keyword = :focus_keyword
                     WHERE id = :id'
                );
                $stmt->execute([
                    'title' => $values['title'],
                    'slug' => $values['slug'],
                    'tag' => $values['tag'],
                    'excerpt' => $values['excerpt'],
                    'content' => $values['content'],
                    'cover_image' => $newCoverImage,
                    'cover_image_alt' => $values['cover_image_alt'] ?: null,
                    'status' => $values['status'],
                    'published_at' => $publishedAt,
                    'meta_title' => $values['meta_title'] ?: null,
                    'meta_description' => $values['meta_description'] ?: null,
                    'focus_keyword' => $values['focus_keyword'] ?: null,
                    'id' => $existing['id'],
                ]);
            } else {
                $stmt = db()->prepare(
                    'INSERT INTO blog_posts (title, slug, tag, excerpt, content, cover_image, cover_image_alt, status,
                         published_at, author_id, meta_title, meta_description, focus_keyword)
                     VALUES (:title, :slug, :tag, :excerpt, :content, :cover_image, :cover_image_alt, :status,
                         :published_at, :author_id, :meta_title, :meta_description, :focus_keyword)'
                );
                $stmt->execute([
                    'title' => $values['title'],
                    'slug' => $values['slug'],
                    'tag' => $values['tag'],
                    'excerpt' => $values['excerpt'],
                    'content' => $values['content'],
                    'cover_image' => $newCoverImage,
                    'cover_image_alt' => $values['cover_image_alt'] ?: null,
                    'status' => $values['status'],
                    'published_at' => $publishedAt,
                    'author_id' => $_SESSION['admin_id'],
                    'meta_title' => $values['meta_title'] ?: null,
                    'meta_description' => $values['meta_description'] ?: null,
                    'focus_keyword' => $values['focus_keyword'] ?: null,
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

      <div class="meta-box mb-4">
        <div class="meta-box-header">Search Engine Preview &amp; SEO</div>
        <div class="meta-box-body">
          <div class="mb-3">
            <label for="focusKeyword" class="form-label small fw-semibold text-muted text-uppercase">Focus Keyword</label>
            <input type="text" id="focusKeyword" name="focus_keyword" class="form-control" maxlength="100" placeholder="e.g. cloud migration services" value="<?= e($values['focus_keyword']) ?>">
          </div>
          <div class="mb-3">
            <label for="metaTitle" class="form-label small fw-semibold text-muted text-uppercase d-flex justify-content-between">
              <span>SEO Title</span>
              <span id="metaTitleCount" class="fw-normal text-muted"></span>
            </label>
            <input type="text" id="metaTitle" name="meta_title" class="form-control" maxlength="200" placeholder="<?= e($values['title'] ?: 'Falls back to the post title') ?>" value="<?= e($values['meta_title']) ?>">
          </div>
          <div class="mb-3">
            <label for="metaDescription" class="form-label small fw-semibold text-muted text-uppercase d-flex justify-content-between">
              <span>Meta Description</span>
              <span id="metaDescriptionCount" class="fw-normal text-muted"></span>
            </label>
            <textarea id="metaDescription" name="meta_description" class="form-control" rows="2" maxlength="300" placeholder="Falls back to the excerpt"><?= e($values['meta_description']) ?></textarea>
          </div>

          <div class="mb-3">
            <div class="form-text mb-1">Google preview</div>
            <div class="serp-preview">
              <div class="serp-preview-url"><?= e(SITE_URL) ?>/blog-post<span class="text-muted">?slug=</span><span id="serpSlug"><?= e($values['slug']) ?></span></div>
              <div class="serp-preview-title" id="serpTitle"></div>
              <div class="serp-preview-desc" id="serpDescription"></div>
            </div>
          </div>

          <ul class="seo-checklist list-unstyled mb-0" id="seoChecklist"></ul>
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
          <input type="file" name="cover_image" class="form-control form-control-sm mb-2" accept="image/jpeg,image/png,image/webp">
          <label for="coverImageAlt" class="form-label small fw-semibold text-muted text-uppercase mb-1">Alt Text</label>
          <input type="text" id="coverImageAlt" name="cover_image_alt" class="form-control form-control-sm" maxlength="200" placeholder="Describes the image for search engines and screen readers" value="<?= e($values['cover_image_alt']) ?>">
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
    setup: function (editor) {
      editor.on('input change undo redo SetContent', function () { updateSeoPanel(); });
    },
  });

  document.getElementById('postEditorForm').addEventListener('submit', function () {
    if (window.tinymce) tinymce.triggerSave();
  });

  // ---------- SEO panel: live Google-style preview + a Yoast-style
  // focus-keyword checklist, recalculated on every relevant keystroke. ----------
  var excerptEl = document.getElementById('excerpt');
  var focusKeywordEl = document.getElementById('focusKeyword');
  var metaTitleEl = document.getElementById('metaTitle');
  var metaDescriptionEl = document.getElementById('metaDescription');
  var metaTitleCountEl = document.getElementById('metaTitleCount');
  var metaDescriptionCountEl = document.getElementById('metaDescriptionCount');
  var serpSlugEl = document.getElementById('serpSlug');
  var serpTitleEl = document.getElementById('serpTitle');
  var serpDescriptionEl = document.getElementById('serpDescription');
  var checklistEl = document.getElementById('seoChecklist');

  function countClass(len, min, max) {
    if (len === 0) return 'text-muted';
    return (len < min || len > max) ? 'text-danger' : 'text-success';
  }

  function checklistItem(ok, label, neutral) {
    var icon = neutral ? 'fa-circle-info text-muted' : (ok ? 'fa-circle-check text-success' : 'fa-circle-xmark text-danger');
    return '<li class="d-flex align-items-start gap-2 small mb-1"><i class="fa-solid ' + icon + ' mt-1"></i><span>' + label + '</span></li>';
  }

  function updateSeoPanel() {
    var title = titleEl.value.trim();
    var slug = slugEl.value.trim();
    var metaTitle = metaTitleEl.value.trim();
    var metaDescription = metaDescriptionEl.value.trim();
    var excerpt = excerptEl.value.trim();
    var keyword = focusKeywordEl.value.trim().toLowerCase();
    var editor = window.tinymce && tinymce.get('content');
    var contentText = editor ? editor.getContent({ format: 'text' }) : '';
    var wordCount = contentText.trim() ? contentText.trim().split(/\s+/).length : 0;

    var displayTitle = metaTitle || title || '(untitled)';
    var displayDescription = metaDescription || excerpt || '';

    serpSlugEl.textContent = slug || 'your-post-slug';
    serpTitleEl.textContent = displayTitle;
    serpDescriptionEl.textContent = displayDescription || 'Add an excerpt or meta description to see it here.';

    metaTitleCountEl.textContent = metaTitle.length + ' / 60';
    metaTitleCountEl.className = 'fw-normal ' + countClass(metaTitle.length, 1, 60);
    metaDescriptionCountEl.textContent = metaDescription.length + ' / 160';
    metaDescriptionCountEl.className = 'fw-normal ' + countClass(metaDescription.length, 50, 160);

    var checks = [];
    if (keyword) {
      var slugKeyword = keyword.replace(/\s+/g, '-');
      checks.push(checklistItem(displayTitle.toLowerCase().indexOf(keyword) !== -1, 'Focus keyword appears in the SEO title'));
      checks.push(checklistItem(displayDescription.toLowerCase().indexOf(keyword) !== -1, 'Focus keyword appears in the meta description'));
      checks.push(checklistItem(slug.toLowerCase().indexOf(slugKeyword) !== -1, 'Focus keyword appears in the URL slug'));
      checks.push(checklistItem(contentText.toLowerCase().indexOf(keyword) !== -1, 'Focus keyword appears in the content'));
    } else {
      checks.push(checklistItem(false, 'Add a focus keyword above to see keyword checks', true));
    }
    checks.push(checklistItem(wordCount >= 300, 'Content is at least 300 words (' + wordCount + ' so far)'));
    checks.push(checklistItem(displayTitle.length > 0 && displayTitle.length <= 60, 'SEO title is 60 characters or fewer'));
    checks.push(checklistItem(displayDescription.length >= 50 && displayDescription.length <= 160, 'Meta description is 50–160 characters'));

    checklistEl.innerHTML = checks.join('');
  }

  [titleEl, slugEl, excerptEl, focusKeywordEl, metaTitleEl, metaDescriptionEl].forEach(function (el) {
    el.addEventListener('input', updateSeoPanel);
  });
  updateSeoPanel();
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
