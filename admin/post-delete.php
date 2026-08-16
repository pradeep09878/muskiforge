<?php

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf_token'] ?? null)) {
    flash_set('error', 'Could not delete that post — please try again.');
    header('Location: ' . url('admin/index.php'));
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

try {
    $stmt = db()->prepare('SELECT cover_image FROM blog_posts WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch();

    if ($post) {
        db()->prepare('DELETE FROM blog_posts WHERE id = :id')->execute(['id' => $id]);

        if (!empty($post['cover_image'])) {
            $path = __DIR__ . '/../' . $post['cover_image'];
            if (is_file($path)) {
                unlink($path);
            }
        }

        flash_set('success', 'Post deleted.');
    } else {
        flash_set('error', 'That post no longer exists.');
    }
} catch (PDOException $e) {
    error_log('[admin-post-delete] ' . $e->getMessage());
    flash_set('error', 'Something went wrong deleting the post. Please try again.');
}

header('Location: ' . url('admin/index.php'));
exit;
