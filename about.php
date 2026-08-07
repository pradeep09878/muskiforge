<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'About Muskiforge | Our Story, Mission & Team',
    'Learn about Muskiforge, an end-to-end IT services company building secure, scalable, and future-ready digital solutions for startups, SMEs, and enterprises.',
    'about.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'About', 'url' => url('about.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">About Us</span>
    <h1 class="section-title mt-2 mb-3">A Team Obsessed With Getting Technology Right</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      Muskiforge is a full-service IT company that builds secure, scalable, and future-ready digital solutions for
      startups, SMEs, and enterprises — from the first line of code to long-term support.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <span class="eyebrow">Our Story</span>
        <h2 class="section-title mt-2 mb-3">Why Muskiforge Exists</h2>
        <p class="section-subtitle mb-3">
          Muskiforge was founded on a simple observation: too many businesses were being sold websites and software
          that looked good in a pitch deck but broke down under real-world traffic, security scrutiny, or growth.
          We set out to build a company that treats engineering discipline, SEO, and design as one connected system
          rather than three separate vendors.
        </p>
        <p class="section-subtitle mb-0">
          Today we work with founders, marketing leaders, and IT directors across healthcare, finance, education,
          logistics, retail, and real estate — building the software and digital infrastructure their businesses
          run on.
        </p>
      </div>
      <div class="col-lg-6">
        <img src="<?= e(asset('images/about-story.jpg')) ?>" alt="Muskiforge team planning a project" class="img-fluid rounded-xl shadow-soft" loading="lazy">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card-why">
          <div class="icon-badge"><i class="fa-solid fa-bullseye"></i></div>
          <h2 class="h5 fw-bold mb-2">Our Mission</h2>
          <p class="section-subtitle mb-0">Building technology that powers business growth — secure, scalable, and measured by outcomes, not just delivery.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-why">
          <div class="icon-badge"><i class="fa-solid fa-eye"></i></div>
          <h2 class="h5 fw-bold mb-2">Our Vision</h2>
          <p class="section-subtitle mb-0">To be the long-term technology partner businesses turn to at every stage of their digital growth, not just for one project.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" id="values">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">What Drives Us</span>
      <h2 class="section-title mt-2 mb-3">Our Values</h2>
    </div>
    <div class="row g-4">
      <?php
      $values = [
          ['fa-solid fa-shield-halved', 'Trust', 'We earn trust through transparent communication and code you can audit, not just promises.'],
          ['fa-solid fa-gauge-high', 'Performance', 'Every deliverable is measured against real performance and business metrics, not vanity benchmarks.'],
          ['fa-solid fa-people-group', 'Partnership', 'We think in terms of long-term relationships, not one-off invoices.'],
          ['fa-solid fa-arrows-rotate', 'Adaptability', 'Technology changes fast; our stack and skills evolve with it.'],
      ];
      foreach ($values as [$icon, $title, $text]): ?>
      <div class="col-md-6 col-lg-3">
        <div class="card-why h-100">
          <div class="icon-badge"><i class="<?= e($icon) ?>"></i></div>
          <h3 class="h6 fw-bold mb-2"><?= e($title) ?></h3>
          <p class="section-subtitle mb-0"><?= e($text) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Let's Build Something Together</h2>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Contact Our Team</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
