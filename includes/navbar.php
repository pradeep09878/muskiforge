<header class="site-header" id="siteHeader">
<nav class="navbar navbar-expand-lg navbar-dark py-0">
  <div class="container">
    <div class="navbar-3d-panel d-flex align-items-center flex-wrap w-100">
      <a class="navbar-brand d-flex align-items-center gap-2 py-0" href="<?= e(url('index.php')) ?>">
        <span class="navbar-mark"><i class="fa-solid fa-bolt" aria-hidden="true"></i></span>
        <span class="navbar-wordmark">Muski<span class="navbar-wordmark-accent">forge</span></span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <div class="navbar-nav-wrap mx-auto">
        <span class="nav-spotlight" aria-hidden="true"></span>
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link<?= nav_active('index.php') ?>" href="<?= e(url('index.php')) ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('about.php') ?>" href="<?= e(url('about.php')) ?>">About</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?= nav_active('services.php') ?>" href="<?= e(url('services.php')) ?>" id="servicesDropdown" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">Services</a>
            <div class="dropdown-menu mega-menu" aria-labelledby="servicesDropdown">
              <div class="mega-menu-grid">
                <?php foreach (services_catalog() as $slug => $navService): ?>
                <a class="mega-menu-item" href="<?= e(url('services/' . $slug . '.php')) ?>">
                  <span class="mega-menu-icon"><i class="<?= e($navService['icon']) ?>" aria-hidden="true"></i></span>
                  <span class="mega-menu-title"><?= e($navService['title']) ?></span>
                </a>
                <?php endforeach; ?>
              </div>
              <div class="mega-menu-footer">
                <a href="<?= e(url('services.php')) ?>">View all services <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i></a>
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link<?= nav_active('portfolio.php') ?>" href="<?= e(url('portfolio.php')) ?>">Portfolio</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('blog.php') ?>" href="<?= e(url('blog.php')) ?>">Blog</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('faq.php') ?>" href="<?= e(url('faq.php')) ?>">FAQs</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('contact.php') ?>" href="<?= e(url('contact.php')) ?>">Contact</a></li>
        </ul>
        </div>
        <a href="<?= e(url('contact.php')) ?>" class="btn btn-nav-cta-3d ms-lg-3">Get Started <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</nav>
</header>
