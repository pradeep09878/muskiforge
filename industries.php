<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Industries We Serve | Healthcare, Finance, Retail & More | Muskiforge',
    'Muskiforge builds technology for healthcare, finance, manufacturing, logistics, retail, education, real estate, hospitality, startups, and professional services.',
    'industries.php'
);

$industryBlurbs = [
    'Healthcare' => 'Patient portals, scheduling, and secure messaging built with data privacy as a first-class requirement.',
    'Manufacturing' => 'Inventory, production tracking, and shop-floor systems that replace spreadsheets with real visibility.',
    'Logistics & Supply Chain' => 'Fleet tracking, dispatch, and routing platforms that keep goods and information moving.',
    'Retail & E-commerce' => 'Storefronts, inventory sync, and checkout flows engineered to convert and to scale with demand.',
    'Finance' => 'Dashboards and internal tools built to the accuracy, security, and audit standards finance teams need.',
    'Education' => 'Learning platforms and admin systems that hold up under real student and faculty load.',
    'Real Estate' => 'Listings, CRM, and lead-routing platforms with map-based search built in.',
    'Hospitality' => 'Booking, guest management, and operations tools tuned to hospitality workflows.',
    'Startups' => 'Fast, focused builds that get a first version in front of users and investors without cutting corners.',
    'Professional Services' => 'Client portals, internal tooling, and automation that cut the busywork out of billable time.',
];

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Industries', 'url' => url('industries.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Who We Work With</span>
    <h1 class="section-title mt-2 mb-3">Industries We Serve</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      Every industry has different constraints. We build technology shaped around the ones that matter for yours —
      compliance, uptime, scale, or speed to launch.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach (industries_served() as $ii => $industry): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-why h-100">
          <div class="icon-badge <?= e(accent_class($ii)) ?>"><i class="<?= e($industry['icon']) ?>" aria-hidden="true"></i></div>
          <h2 class="h6 fw-bold mb-2"><?= e($industry['name']) ?></h2>
          <p class="section-subtitle mb-0"><?= e($industryBlurbs[$industry['name']] ?? '') ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Don't See Your Industry?</h2>
      <p class="mb-4 mx-auto" style="max-width:520px;opacity:.9">We work across sectors — if your business runs on technology, we can help you build it.</p>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Talk to Us</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
