<?php
/**
 * One-time CLI helper to create (or reset) a blog admin account.
 * Usage:  php database/create-admin.php <username> <password>
 *
 * CLI only — refuses to run under a web server so credentials never
 * travel as a URL/query string.
 */

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('This script can only be run from the command line.');
}

require __DIR__ . '/../config.php';

$username = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$username || !$password) {
    fwrite(STDERR, "Usage: php database/create-admin.php <username> <password>\n");
    exit(1);
}

if (strlen($password) < 10) {
    fwrite(STDERR, "Password must be at least 10 characters.\n");
    exit(1);
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = db()->prepare(
    'INSERT INTO admins (username, password_hash) VALUES (:username, :hash)
     ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)'
);
$stmt->execute(['username' => $username, 'hash' => $hash]);

echo "Admin '{$username}' created/updated.\n";
