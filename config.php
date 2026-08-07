<?php
/**
 * Global site configuration.
 * Copy to config.php on each environment and adjust values;
 * keep real DB credentials out of version control via config.local.php.
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0'); // flipped to '1' in config.local.php on dev boxes

define('SITE_NAME', 'Muskiforge');
define('SITE_TITLE', 'Muskiforge | End-to-End IT Services & Digital Solutions');
define('SITE_TAGLINE', 'Building Technology That Powers Business Growth');
define('SITE_URL', 'https://muskiforge.com');
define('SITE_EMAIL', 'hello@muskiforge.com');
define('SITE_PHONE', '+1 (555) 010-2024');
define('SITE_ADDRESS', '2nd Floor, Tech Park One, Business Bay');

define('SOCIAL_LINKEDIN', 'https://linkedin.com/company/muskiforge');
define('SOCIAL_TWITTER', 'https://twitter.com/muskiforge');
define('SOCIAL_FACEBOOK', 'https://facebook.com/muskiforge');
define('SOCIAL_INSTAGRAM', 'https://instagram.com/muskiforge');
define('SOCIAL_GITHUB', 'https://github.com/muskiforge');

define('DB_HOST', 'localhost');
define('DB_NAME', 'muskiforge');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Environment-specific overrides (gitignored). Safe to omit in production
// as long as the constants above are correct for that environment.
$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require $localConfig;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    return $pdo;
}
