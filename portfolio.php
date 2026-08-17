<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Portfolio | Web, Mobile & Enterprise Software Projects | Muskiforge',
    'Browse Muskiforge\'s portfolio of web apps, mobile apps, enterprise software, e-commerce, and cloud solutions delivered for clients across healthcare, finance, retail, and more.',
    'portfolio.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Portfolio', 'url' => url('portfolio.php')],
]);

$projects = [
    ['NovaHealth Patient Portal', 'Web Apps', 'Healthcare', 'fa-solid fa-globe', 'A HIPAA-conscious patient portal handling appointment scheduling and secure messaging for a multi-clinic healthcare network.'],
    ['Finlytics Trading Dashboard', 'Enterprise Software', 'Finance', 'fa-solid fa-chart-line', 'A real-time trading analytics dashboard processing high-frequency market data for institutional clients.'],
    ['BrightRetail Storefront', 'E-commerce', 'Retail', 'fa-solid fa-cart-shopping', 'A headless e-commerce storefront rebuild that cut checkout abandonment and tripled organic traffic.'],
    ['CargoLine Fleet Tracker', 'Mobile Apps', 'Logistics', 'fa-solid fa-mobile-screen-button', 'A cross-platform Flutter app giving dispatchers live GPS tracking across a 200-vehicle fleet.'],
    ['EduSphere LMS Migration', 'Cloud Solutions', 'Education', 'fa-solid fa-cloud', 'A full migration of a legacy learning management system to AWS with zero downtime during the school term.'],
    ['UrbanEstate Listings Platform', 'Web Apps', 'Real Estate', 'fa-solid fa-globe', 'A listings and CRM platform for a regional real estate brokerage with map-based search and lead routing.'],
    ['Manufaco Inventory System', 'Enterprise Software', 'Manufacturing', 'fa-solid fa-boxes-stacked', 'A custom inventory and production-tracking system replacing spreadsheets across three factory sites.'],
    ['LaunchPad Startup Suite', 'Web Apps', 'Startups', 'fa-solid fa-rocket', 'A full marketing site plus investor-facing dashboard built and shipped in under four weeks for a seed-stage startup.'],
];

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Our Work</span>
    <h1 class="section-title mt-2 mb-3">Projects We're Proud Of</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      A selection of web apps, mobile apps, enterprise software, e-commerce platforms, and cloud migrations we've delivered.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($projects as $pi => [$title, $tag, $industry, $icon, $desc]): $tv = tonal_vars($pi); ?>
      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card portfolio-block position-relative mb-3" style="background:<?= e($tv['bg']) ?>;color:<?= e($tv['fg']) ?>">
          <span class="portfolio-tag"><?= e($tag) ?></span>
          <i class="<?= e($icon) ?> portfolio-block-icon" aria-hidden="true"></i>
        </div>
        <h2 class="h6 fw-bold mb-1"><?= e($title) ?></h2>
        <p class="small text-muted mb-1"><?= e($industry) ?></p>
        <p class="section-subtitle mb-0"><?= e($desc) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Have a Project in Mind?</h2>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Start a Project</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
