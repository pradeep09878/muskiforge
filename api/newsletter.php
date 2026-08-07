<?php
/**
 * Handles newsletter signups from the footer form (AJAX POST).
 * Always responds with JSON: {"success": bool, "message": string}.
 */

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

function respond(bool $success, string $message, int $status = 200): never
{
    http_response_code($status);
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', 405);
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    respond(false, 'Your session expired. Please refresh the page and try again.', 419);
}

$email = trim((string) ($_POST['email'] ?? ''));

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 180) {
    respond(false, 'Please enter a valid email address.', 422);
}

try {
    $stmt = db()->prepare(
        'INSERT INTO newsletter_subscribers (email) VALUES (:email)
         ON DUPLICATE KEY UPDATE is_active = 1'
    );
    $stmt->execute(['email' => $email]);
} catch (PDOException $e) {
    error_log('[newsletter] ' . $e->getMessage());
    respond(false, 'Something went wrong on our end. Please try again later.', 500);
}

respond(true, "You're subscribed! Thanks for joining.");
