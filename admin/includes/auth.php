<?php
/**
 * Auth guard — require this at the top of every protected admin page.
 * Redirects to the login screen if no admin session is active.
 */

declare(strict_types=1);

require __DIR__ . '/../../config.php';
require __DIR__ . '/../../includes/functions.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: ' . url('admin/login.php'));
    exit;
}
