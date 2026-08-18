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
    [
        'title' => 'NovaHealth Patient Portal', 'category' => 'Web Apps', 'industry' => 'Healthcare',
        'icon' => 'fa-solid fa-heart-pulse',
        'desc' => 'A HIPAA-conscious patient portal handling appointment scheduling and secure messaging for a multi-clinic healthcare network.',
        'result' => '3× faster appointment booking', 'stack' => ['React', 'Node.js', 'PostgreSQL'],
    ],
    [
        'title' => 'Finlytics Trading Dashboard', 'category' => 'Enterprise Software', 'industry' => 'Finance',
        'icon' => 'fa-solid fa-chart-line',
        'desc' => 'A real-time trading analytics dashboard processing high-frequency market data for institutional clients.',
        'result' => 'Sub-second data refresh at scale', 'stack' => ['Python', 'WebSocket', 'Redis'],
    ],
    [
        'title' => 'BrightRetail Storefront', 'category' => 'E-commerce', 'industry' => 'Retail',
        'icon' => 'fa-solid fa-cart-shopping',
        'desc' => 'A headless e-commerce storefront rebuild that cut checkout abandonment and tripled organic traffic.',
        'result' => '3× organic traffic growth', 'stack' => ['Next.js', 'Shopify Headless', 'Algolia'],
    ],
    [
        'title' => 'CargoLine Fleet Tracker', 'category' => 'Mobile Apps', 'industry' => 'Logistics',
        'icon' => 'fa-solid fa-location-crosshairs',
        'desc' => 'A cross-platform Flutter app giving dispatchers live GPS tracking across a 200-vehicle fleet.',
        'result' => 'Live tracking on 200+ vehicles', 'stack' => ['Flutter', 'Firebase', 'Maps API'],
    ],
    [
        'title' => 'EduSphere LMS Migration', 'category' => 'Cloud Solutions', 'industry' => 'Education',
        'icon' => 'fa-solid fa-cloud-arrow-up',
        'desc' => 'A full migration of a legacy learning management system to AWS with zero downtime during the school term.',
        'result' => 'Zero-downtime mid-semester cutover', 'stack' => ['AWS', 'Terraform', 'Moodle'],
    ],
    [
        'title' => 'UrbanEstate Listings Platform', 'category' => 'Web Apps', 'industry' => 'Real Estate',
        'icon' => 'fa-solid fa-map-location-dot',
        'desc' => 'A listings and CRM platform for a regional real estate brokerage with map-based search and lead routing.',
        'result' => '40% faster lead response time', 'stack' => ['Laravel', 'MySQL', 'Mapbox'],
    ],
    [
        'title' => 'Manufaco Inventory System', 'category' => 'Enterprise Software', 'industry' => 'Manufacturing',
        'icon' => 'fa-solid fa-boxes-stacked',
        'desc' => 'A custom inventory and production-tracking system replacing spreadsheets across three factory sites.',
        'result' => '3 factory sites on one system', 'stack' => ['Vue.js', '.NET', 'SQL Server'],
    ],
    [
        'title' => 'LaunchPad Startup Suite', 'category' => 'Web Apps', 'industry' => 'Startups',
        'icon' => 'fa-solid fa-rocket',
        'desc' => 'A full marketing site plus investor-facing dashboard built and shipped in under four weeks for a seed-stage startup.',
        'result' => 'Shipped investor-ready in 4 weeks', 'stack' => ['Next.js', 'Tailwind', 'Stripe'],
    ],
];

$portfolioCategories = ['All', 'Web Apps', 'Enterprise Software', 'E-commerce', 'Mobile Apps', 'Cloud Solutions'];

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

<section class="py-4">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-center gap-2 portfolio-filters" role="group" aria-label="Filter projects by category">
      <?php foreach ($portfolioCategories as $ci => $cat): ?>
      <button type="button" class="portfolio-filter-btn<?= $ci === 0 ? ' active' : '' ?>" data-filter="<?= e($ci === 0 ? 'all' : $cat) ?>"><?= e($cat) ?></button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-3 pb-5">
  <div class="container">
    <div class="row g-4" id="portfolioGrid">
      <?php foreach ($projects as $pi => $p): $tv = tonal_vars($pi); ?>
      <div class="col-md-6 col-lg-4 portfolio-item" data-category="<?= e($p['category']) ?>">
        <div class="portfolio-card h-100">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="portfolio-icon-tile" style="background:<?= e($tv['bg']) ?>;color:<?= e($tv['fg']) ?>">
              <i class="<?= e($p['icon']) ?>" aria-hidden="true"></i>
            </div>
            <span class="portfolio-tag-inline"><?= e($p['category']) ?></span>
          </div>
          <div>
            <h2 class="h6 fw-bold mb-1"><?= e($p['title']) ?></h2>
            <p class="small text-muted mb-2"><i class="fa-solid fa-building me-1 text-accent" aria-hidden="true"></i><?= e($p['industry']) ?></p>
            <p class="section-subtitle mb-2"><?= e($p['desc']) ?></p>
            <p class="portfolio-result mb-2"><i class="fa-solid fa-arrow-trend-up me-2" aria-hidden="true"></i><?= e($p['result']) ?></p>
            <div class="d-flex flex-wrap gap-2">
              <?php foreach ($p['stack'] as $tech): ?>
              <span class="portfolio-stack-tag"><?= e($tech) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <p class="text-center text-muted mt-5 d-none" id="portfolioEmpty">No projects in this category yet — check back soon.</p>
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
