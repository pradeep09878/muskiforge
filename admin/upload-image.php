<?php
/**
 * In-content image upload endpoint for the post editor's rich text
 * toolbar (TinyMCE's images_upload_url contract: respond with JSON
 * {location: "<url>"} on success, or a non-2xx status with a plain
 * error message on failure).
 */

declare(strict_types=1);

require __DIR__ . '/includes/auth.php';

header('Content-Type: application/json');

const MAX_IMAGE_BYTES = 5 * 1024 * 1024;
const ALLOWED_IMAGE_TYPES = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['file'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No file received.']);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['error' => 'Your session expired — reload the page and try again.']);
    exit;
}

$file = $_FILES['file'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Upload failed.']);
    exit;
}

if ($file['size'] > MAX_IMAGE_BYTES) {
    http_response_code(400);
    echo json_encode(['error' => 'Image must be 5MB or smaller.']);
    exit;
}

$mimeType = mime_content_type($file['tmp_name']) ?: '';
$extension = ALLOWED_IMAGE_TYPES[$mimeType] ?? null;

if (!$extension) {
    http_response_code(400);
    echo json_encode(['error' => 'Image must be a JPG, PNG, GIF, or WEBP file.']);
    exit;
}

$uploadDir = __DIR__ . '/../uploads/blog/content';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$filename = bin2hex(random_bytes(8)) . '.' . $extension;

if (!move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $filename)) {
    http_response_code(500);
    echo json_encode(['error' => 'The image could not be saved.']);
    exit;
}

echo json_encode(['location' => url('uploads/blog/content/' . $filename)]);
