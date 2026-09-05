<?php
/**
 * Bulk actions for the post list (admin/index.php): delete, publish, or
 * move back to draft, for a set of checked posts at once.
 */

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf_token'] ?? null)) {
    flash_set('error', 'Could not apply that action — please try again.');
    header('Location: ' . url('admin/index.php'));
    exit;
}

$action = (string) ($_POST['bulk_action'] ?? '');
$ids = array_values(array_unique(array_map('intval', (array) ($_POST['post'] ?? []))));
$ids = array_filter($ids, static fn (int $id): bool => $id > 0);

if (!$ids || !in_array($action, ['delete', 'publish', 'draft'], true)) {
    flash_set('error', 'Select at least one post and a bulk action first.');
    header('Location: ' . url('admin/index.php'));
    exit;
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));

try {
    if ($action === 'delete') {
        $stmt = db()->prepare("SELECT cover_image FROM blog_posts WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $covers = $stmt->fetchAll(PDO::FETCH_COLUMN);

        db()->prepare("DELETE FROM blog_posts WHERE id IN ($placeholders)")->execute($ids);

        foreach ($covers as $cover) {
            if (!empty($cover)) {
                $path = __DIR__ . '/../' . $cover;
                if (is_file($path)) {
                    unlink($path);
                }
            }
        }

        flash_set('success', count($ids) . ' post(s) deleted.');
    } else {
        $status = $action === 'publish' ? 'published' : 'draft';

        if ($status === 'published') {
            db()->prepare(
                "UPDATE blog_posts SET status = 'published', published_at = COALESCE(published_at, NOW())
                 WHERE id IN ($placeholders)"
            )->execute($ids);
        } else {
            db()->prepare("UPDATE blog_posts SET status = 'draft' WHERE id IN ($placeholders)")->execute($ids);
        }

        flash_set('success', count($ids) . ' post(s) updated.');
    }
} catch (PDOException $e) {
    error_log('[admin-post-bulk] ' . $e->getMessage());
    flash_set('error', 'Something went wrong applying that action. Please try again.');
}

header('Location: ' . url('admin/index.php'));
exit;
