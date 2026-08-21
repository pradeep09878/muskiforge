<header class="site-header" id="siteHeader">
<nav class="navbar navbar-expand-lg navbar-dark py-0">
  <div class="container">
    <div class="navbar-3d-panel d-flex align-items-center justify-content-between flex-wrap w-100">
      <a class="navbar-brand d-flex align-items-center gap-2 py-0" href="<?= e(url('index.php')) ?>">
        <span class="navbar-mark"><i class="fa-solid fa-bolt" aria-hidden="true"></i></span>
        <span class="navbar-wordmark">Muski<span class="navbar-wordmark-accent">forge</span></span>
      </a>

      <button class="navbar-toggler-3d" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-3d-bar"></span>
        <span class="navbar-toggler-3d-bar"></span>
        <span class="navbar-toggler-3d-bar"></span>
      </button>

      <div class="navbar-nav-wrap d-none d-lg-flex mx-auto">
        <span class="nav-spotlight" aria-hidden="true"></span>
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link<?= nav_active('index.php') ?>" href="<?= e(url('index.php')) ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('about.php') ?>" href="<?= e(url('about.php')) ?>">About Us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle<?= nav_active('services.php') ?>" href="<?= e(url('services.php')) ?>" id="servicesDropdown" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">Services</a>
            <div class="dropdown-menu mega-menu" aria-labelledby="servicesDropdown">
              <?php $svc = services_catalog(); ?>
              <div class="mega-menu-columns">
                <div class="mega-menu-col">
                  <span class="mega-menu-col-title">IT Infrastructure</span>
                  <?php foreach (['cloud-solutions', 'it-consulting'] as $slug): $s = $svc[$slug]; ?>
                  <a class="mega-menu-item" href="<?= e(url('services/' . $slug . '.php')) ?>">
                    <span class="mega-menu-icon"><i class="<?= e($s['icon']) ?>" aria-hidden="true"></i></span>
                    <span class="mega-menu-title"><?= e($s['title']) ?></span>
                  </a>
                  <?php endforeach; ?>
                </div>
                <div class="mega-menu-col">
                  <span class="mega-menu-col-title">Software Development</span>
                  <?php foreach (['website-development', 'software-development', 'mobile-app-development'] as $slug): $s = $svc[$slug]; ?>
                  <a class="mega-menu-item" href="<?= e(url('services/' . $slug . '.php')) ?>">
                    <span class="mega-menu-icon"><i class="<?= e($s['icon']) ?>" aria-hidden="true"></i></span>
                    <span class="mega-menu-title"><?= e($s['title']) ?></span>
                  </a>
                  <?php endforeach; ?>
                </div>
                <div class="mega-menu-col">
                  <span class="mega-menu-col-title">Digital Solutions</span>
                  <?php foreach (['digital-marketing', 'seo-services', 'content-writing'] as $slug): $s = $svc[$slug]; ?>
                  <a class="mega-menu-item" href="<?= e(url('services/' . $slug . '.php')) ?>">
                    <span class="mega-menu-icon"><i class="<?= e($s['icon']) ?>" aria-hidden="true"></i></span>
                    <span class="mega-menu-title"><?= e($s['title']) ?></span>
                  </a>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="mega-menu-footer">
                <a href="<?= e(url('services.php')) ?>">View all services <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i></a>
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link<?= nav_active('services.php') ?>" href="<?= e(url('services.php')) ?>">Solutions</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('industries.php') ?>" href="<?= e(url('industries.php')) ?>">Industries</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('portfolio.php') ?>" href="<?= e(url('portfolio.php')) ?>">Portfolio</a></li>
          <li class="nav-item"><a class="nav-link<?= nav_active('contact.php') ?>" href="<?= e(url('contact.php')) ?>">Contact Us</a></li>
        </ul>
      </div>

      <a href="<?= e(url('contact.php')) ?>" class="btn btn-nav-cta-3d d-none d-lg-inline-flex">Get a Free Consultation <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i></a>
    </div>
  </div>
</nav>
</header>

<!-- Mobile off-canvas nav panel -->
<div class="offcanvas offcanvas-end mobile-nav-panel" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
  <div class="offcanvas-header">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= e(url('index.php')) ?>" id="mobileNavLabel">
      <span class="navbar-mark"><i class="fa-solid fa-bolt" aria-hidden="true"></i></span>
      <span class="navbar-wordmark">Muski<span class="navbar-wordmark-accent">forge</span></span>
    </a>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column">
    <ul class="mobile-nav-list list-unstyled mb-4">
      <li><a class="mobile-nav-link<?= nav_active('index.php') ?>" href="<?= e(url('index.php')) ?>">Home</a></li>
      <li><a class="mobile-nav-link<?= nav_active('about.php') ?>" href="<?= e(url('about.php')) ?>">About Us</a></li>
      <li>
        <button class="mobile-nav-link mobile-nav-expand" type="button" data-bs-toggle="collapse" data-bs-target="#mobileServicesSub" aria-expanded="false" aria-controls="mobileServicesSub">
          Services <i class="fa-solid fa-chevron-down ms-auto" aria-hidden="true"></i>
        </button>
        <div class="collapse" id="mobileServicesSub">
          <ul class="mobile-nav-sublist list-unstyled">
            <?php foreach (services_catalog() as $slug => $s): ?>
            <li><a href="<?= e(url('services/' . $slug . '.php')) ?>"><i class="<?= e($s['icon']) ?> me-2" aria-hidden="true"></i><?= e($s['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </li>
      <li><a class="mobile-nav-link<?= nav_active('services.php') ?>" href="<?= e(url('services.php')) ?>">Solutions</a></li>
      <li><a class="mobile-nav-link<?= nav_active('industries.php') ?>" href="<?= e(url('industries.php')) ?>">Industries</a></li>
      <li><a class="mobile-nav-link<?= nav_active('portfolio.php') ?>" href="<?= e(url('portfolio.php')) ?>">Portfolio</a></li>
      <li><a class="mobile-nav-link<?= nav_active('blog.php') ?>" href="<?= e(url('blog.php')) ?>">Blog</a></li>
      <li><a class="mobile-nav-link<?= nav_active('contact.php') ?>" href="<?= e(url('contact.php')) ?>">Contact Us</a></li>
    </ul>
    <a href="<?= e(url('contact.php')) ?>" class="btn btn-nav-cta-3d d-flex w-100 mt-auto justify-content-center">Get a Free Consultation <i class="fa-solid fa-arrow-right ms-1" aria-hidden="true"></i></a>
  </div>
</div>
