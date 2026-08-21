<footer class="site-footer bg-dark text-light pt-5 pb-4">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6">
        <a class="navbar-brand fw-bold fs-4 text-white" href="<?= e(url('index.php')) ?>">Muski<span class="text-accent">forge</span></a>
        <p class="mt-3 text-light-50">Muskiforge helps startups, SMEs, and enterprises accelerate growth with custom software, websites, mobile apps, cloud solutions, SEO, and IT consulting.</p>
        <div class="d-flex gap-3 mt-3 fs-5">
          <a href="<?= e(SOCIAL_LINKEDIN) ?>" class="text-light" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
          <a href="<?= e(SOCIAL_TWITTER) ?>" class="text-light" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="<?= e(SOCIAL_FACEBOOK) ?>" class="text-light" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
          <a href="<?= e(SOCIAL_INSTAGRAM) ?>" class="text-light" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="<?= e(SOCIAL_GITHUB) ?>" class="text-light" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3">Services</h6>
        <ul class="list-unstyled footer-links">
          <?php foreach (services_catalog() as $slug => $footerService): ?>
          <li><a href="<?= e(url('services/' . $slug . '.php')) ?>"><?= e($footerService['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="col-lg-2 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3">Quick Links</h6>
        <ul class="list-unstyled footer-links">
          <li><a href="<?= e(url('about.php')) ?>">About Us</a></li>
          <li><a href="<?= e(url('industries.php')) ?>">Industries</a></li>
          <li><a href="<?= e(url('portfolio.php')) ?>">Portfolio</a></li>
          <li><a href="<?= e(url('blog.php')) ?>">Blog</a></li>
          <li><a href="<?= e(url('faq.php')) ?>">FAQs</a></li>
          <li><a href="<?= e(url('contact.php')) ?>">Contact</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6">
        <h6 class="text-uppercase fw-bold mb-3">Stay Updated</h6>
        <p class="text-light-50">Subscribe for insights on software, SEO, and digital growth.</p>
        <form action="<?= e(url('api/newsletter.php')) ?>" method="post" class="d-flex gap-2 newsletter-form" data-ajax-form>
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <label for="footerEmail" class="visually-hidden">Email address</label>
          <input type="email" id="footerEmail" name="email" required class="form-control" placeholder="you@company.com">
          <button type="submit" class="btn btn-accent flex-shrink-0">Subscribe</button>
        </form>
        <div class="form-status mt-2" data-form-status></div>
        <p class="mt-3 mb-1 text-light-50"><i class="fa-solid fa-envelope me-2"></i><?= e(SITE_EMAIL) ?></p>
        <p class="mb-0 text-light-50"><i class="fa-solid fa-phone me-2"></i><?= e(SITE_PHONE) ?></p>
      </div>
    </div>

    <hr class="border-secondary mt-5 mb-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p class="mb-0 text-light-50">&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</p>
      <ul class="list-inline mb-0">
        <li class="list-inline-item"><a href="<?= e(url('privacy-policy.php')) ?>" class="text-light-50">Privacy Policy</a></li>
        <li class="list-inline-item ms-3"><a href="<?= e(url('terms.php')) ?>" class="text-light-50">Terms of Service</a></li>
      </ul>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>
