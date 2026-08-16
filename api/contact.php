<?php
/**
 * Handles the contact form submission from contact.php (AJAX POST).
 * Always responds with JSON: {"success": bool, "message": string}.
 */

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/crm.php';

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

// Honeypot: real visitors never see or fill this field.
if (!empty($_POST['website'])) {
    respond(true, 'Thank you! We will be in touch shortly.');
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$service = trim((string) ($_POST['service'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || mb_strlen($name) > 120) {
    respond(false, 'Please enter a valid name.', 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 180) {
    respond(false, 'Please enter a valid email address.', 422);
}
if ($message === '' || mb_strlen($message) > 4000) {
    respond(false, 'Please enter a project description under 4000 characters.', 422);
}

$validServices = array_keys(services_catalog());
if ($service !== '' && $service !== 'other' && !in_array($service, $validServices, true)) {
    $service = 'other';
}

try {
    $stmt = db()->prepare(
        'INSERT INTO contact_submissions (name, email, phone, service, message, ip_address)
         VALUES (:name, :email, :phone, :service, :message, :ip_address)'
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone !== '' ? $phone : null,
        'service' => $service !== '' ? $service : null,
        'message' => $message,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);
} catch (PDOException $e) {
    error_log('[contact-form] ' . $e->getMessage());
    respond(false, 'Something went wrong on our end. Please try again or email us directly.', 500);
}

$notifyHeaders = "From: " . SITE_NAME . " Website <no-reply@muskiforge.com>\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";
$notifyBody = "New contact form submission:\n\nName: {$name}\nEmail: {$email}\nPhone: {$phone}\nService: {$service}\n\nMessage:\n{$message}";
@mail(SITE_EMAIL, 'New Contact Form Submission - ' . SITE_NAME, $notifyBody, $notifyHeaders);

// Best effort: the lead is already safely stored above, so a slow/down
// CRM never blocks or fails the visitor's confirmation.
push_lead_to_crm([
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message,
]);

respond(true, 'Thank you! Your message has been sent — we will respond within one business day.');
