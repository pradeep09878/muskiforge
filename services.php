<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'IT Services | Web, Software, Mobile, Cloud, SEO & Marketing | Muskiforge',
    'Explore Muskiforge\'s full range of IT services: website development, software development, mobile app development, cloud solutions, SEO, digital marketing, and IT consulting.',
    'services.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Services', 'url' => url('services.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Our Services</span>
    <h1 class="section-title mt-2 mb-3">End-to-End IT Services & Digital Solutions</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      Everything your business needs to design, build, launch, and grow its digital presence — under one roof.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach (services_catalog() as $slug => $service): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service h-100">
          <div class="icon-badge"><i class="<?= e($service['icon']) ?>"></i></div>
          <h2 class="h5 fw-bold mb-2"><?= e($service['title']) ?></h2>
          <p class="section-subtitle mb-3"><?= e($service['description']) ?></p>
          <a href="<?= e(url('services/' . $slug . '.php')) ?>" class="fw-semibold text-accent text-decoration-none">Learn More <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Not Sure Which Service You Need?</h2>
      <p class="mb-4 mx-auto" style="max-width:520px;opacity:.9">Book a free consultation and we'll help you scope the right solution for your goals and budget.</p>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Book a Consultation</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
