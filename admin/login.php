<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';

// Already signed in — no reason to see the login form again.
if (!empty($_SESSION['admin_id'])) {
    header('Location: ' . url('admin/index.php'));
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Your session expired. Please try again.';
    } else {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        // Cheap brute-force throttle: each consecutive failure in this
        // session adds delay, capped so the login page never hangs badly.
        $attempts = (int) ($_SESSION['login_attempts'] ?? 0);
        if ($attempts > 0) {
            usleep(min($attempts, 4) * 400000);
        }

        $admin = null;
        try {
            if ($username !== '' && $password !== '') {
                $stmt = db()->prepare('SELECT id, username, password_hash FROM admins WHERE username = :username LIMIT 1');
                $stmt->execute(['username' => $username]);
                $admin = $stmt->fetch() ?: null;
            }

            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = (int) $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                unset($_SESSION['login_attempts']);
                header('Location: ' . url('admin/index.php'));
                exit;
            }

            $_SESSION['login_attempts'] = $attempts + 1;
            $error = 'Incorrect username or password.';
        } catch (PDOException $e) {
            error_log('[admin-login] ' . $e->getMessage());
            $error = 'Something went wrong on our end. Please try again shortly.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Admin Login | <?= e(SITE_NAME) ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body class="d-flex align-items-center" style="min-height:100vh;background:var(--mf-dark)">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-11 col-sm-8 col-md-5 col-lg-4">
      <div class="rounded-xl p-4 p-md-5 bg-white shadow-soft">
        <h1 class="h4 fw-bold mb-1">Muskiforge Admin</h1>
        <p class="section-subtitle mb-4">Sign in to manage blog posts.</p>

        <?php if ($error): ?>
        <div class="alert alert-danger py-2 small" role="alert"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <div class="mb-3">
            <label for="username" class="form-label fw-semibold">Username</label>
            <input type="text" id="username" name="username" class="form-control" required autofocus autocomplete="username">
          </div>
          <div class="mb-4">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
          </div>
          <button type="submit" class="btn btn-accent w-100 fw-semibold">Sign In</button>
        </form>
      </div>
      <p class="text-center mt-3"><a href="<?= e(url('index.php')) ?>" class="small text-decoration-none" style="color:rgba(255,255,255,.7)">&larr; Back to site</a></p>
    </div>
  </div>
</div>
</body>
</html>
