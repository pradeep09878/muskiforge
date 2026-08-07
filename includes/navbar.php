<header class="site-header">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="<?= e(url('index.php')) ?>">
      Muski<span class="text-accent">forge</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link<?= nav_active('index.php') ?>" href="<?= e(url('index.php')) ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link<?= nav_active('about.php') ?>" href="<?= e(url('about.php')) ?>">About</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle<?= nav_active('services.php') ?>" href="<?= e(url('services.php')) ?>" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
          <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
            <?php foreach (services_catalog() as $slug => $navService): ?>
            <li><a class="dropdown-item" href="<?= e(url('services/' . $slug . '.php')) ?>"><i class="<?= e($navService['icon']) ?> me-2 text-accent"></i><?= e($navService['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link<?= nav_active('portfolio.php') ?>" href="<?= e(url('portfolio.php')) ?>">Portfolio</a></li>
        <li class="nav-item"><a class="nav-link<?= nav_active('blog.php') ?>" href="<?= e(url('blog.php')) ?>">Blog</a></li>
        <li class="nav-item"><a class="nav-link<?= nav_active('faq.php') ?>" href="<?= e(url('faq.php')) ?>">FAQs</a></li>
        <li class="nav-item"><a class="nav-link<?= nav_active('contact.php') ?>" href="<?= e(url('contact.php')) ?>">Contact</a></li>
      </ul>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-accent rounded-pill px-4 ms-lg-3">Get Started</a>
    </div>
  </div>
</nav>
</header>
