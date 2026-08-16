<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?= e($adminTitle ?? 'Admin') ?> | <?= e(SITE_NAME) ?> Admin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold" href="<?= e(url('admin/index.php')) ?>">Muski<span class="text-accent">forge</span> <span class="fw-normal text-muted">Admin</span></a>
    <div class="d-flex align-items-center gap-3 ms-auto">
      <a href="<?= e(url('admin/post-edit.php')) ?>" class="btn btn-accent btn-sm rounded-pill px-3"><i class="fa-solid fa-plus me-1"></i>New Post</a>
      <span class="small text-muted d-none d-sm-inline"><?= e($_SESSION['admin_username'] ?? '') ?></span>
      <a href="<?= e(url('admin/logout.php')) ?>" class="small text-decoration-none">Log Out</a>
    </div>
  </div>
</nav>

<main class="container-fluid px-4 py-4">
