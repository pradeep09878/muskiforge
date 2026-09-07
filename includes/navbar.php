<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span><i class="fa-solid fa-envelope" aria-hidden="true"></i> <a href="mailto:<?= e(SITE_EMAIL) ?>" style="color:inherit"><?= e(SITE_EMAIL) ?></a></span>
      <span><i class="fa-solid fa-phone" aria-hidden="true"></i> <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', SITE_PHONE)) ?>" style="color:inherit"><?= e(SITE_PHONE) ?></a></span>
    </div>
    <div class="topbar-right">
      <span class="topbar-badge"><i class="fa-solid fa-circle pulse-dot" aria-hidden="true"></i> 24/7 Support</span>
      <div class="social-links">
        <a href="<?= e(SOCIAL_LINKEDIN) ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
        <a href="<?= e(SOCIAL_TWITTER) ?>" aria-label="Twitter / X" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
        <a href="<?= e(SOCIAL_FACEBOOK) ?>" aria-label="Facebook" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>

<header class="navbar" id="siteHeader">
  <div class="nav-inner">
    <a href="<?= e(url('index.php')) ?>" class="logo">
      <span class="logo-icon"><i class="fa-solid fa-bolt" aria-hidden="true"></i></span>
      <span class="logo-name">Muski<span class="logo-domain">forge</span></span>
    </a>

    <nav class="nav-pill" aria-label="Primary">
      <ul class="nav-menu" id="navMenu">
        <li><a href="<?= e(url('index.php')) ?>" class="<?= ltrim(nav_active('index.php')) ?>">Home</a></li>
        <li><a href="<?= e(url('about.php')) ?>" class="<?= ltrim(nav_active('about.php')) ?>">About Us</a></li>
        <li class="has-dropdown">
          <a href="<?= e(url('services.php')) ?>" class="<?= ltrim(nav_active('services.php')) ?>" id="servicesDropdown" aria-haspopup="true" aria-expanded="false">
            Services <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="servicesDropdown">
            <?php foreach (services_catalog() as $slug => $s): ?>
            <a href="<?= e(url('services/' . $slug . '.php')) ?>"><i class="<?= e($s['icon']) ?>" aria-hidden="true"></i> <?= e($s['title']) ?></a>
            <?php endforeach; ?>
          </div>
        </li>
        <li><a href="<?= e(url('services.php')) ?>" class="<?= ltrim(nav_active('services.php')) ?>">Solutions</a></li>
        <li><a href="<?= e(url('industries.php')) ?>" class="<?= ltrim(nav_active('industries.php')) ?>">Industries</a></li>
        <li><a href="<?= e(url('portfolio.php')) ?>" class="<?= ltrim(nav_active('portfolio.php')) ?>">Portfolio</a></li>
        <li><a href="<?= e(url('blog.php')) ?>" class="<?= ltrim(nav_active('blog.php')) ?>">Blog</a></li>
        <li><a href="<?= e(url('contact.php')) ?>" class="<?= ltrim(nav_active('contact.php')) ?>">Contact Us</a></li>
      </ul>
    </nav>

    <a href="<?= e(url('contact.php')) ?>" class="nav-cta"><i class="fa-solid fa-phone" aria-hidden="true"></i> Get a Free Consultation</a>

    <button type="button" class="hamburger" id="hamburgerBtn" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navMenu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>

<div class="mobile-overlay" id="mobileOverlay"></div>
