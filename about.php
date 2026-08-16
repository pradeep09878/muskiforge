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
        <svg class="img-fluid rounded-xl shadow-soft" viewBox="0 0 560 420" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="storyIllustrationTitle">
          <title id="storyIllustrationTitle">Abstract illustration of a winding path with milestone markers representing Muskiforge's growth story</title>
          <defs>
            <linearGradient id="storyBg" x1="0" y1="1" x2="1" y2="0">
              <stop offset="0%" stop-color="#e3f9f1"/>
              <stop offset="100%" stop-color="#eaf1ff"/>
            </linearGradient>
          </defs>
          <rect width="560" height="420" rx="20" fill="url(#storyBg)"/>
          <path d="M60 360 C 160 360, 160 260, 260 260 S 360 160, 460 160 S 500 90, 500 60"
                fill="none" stroke="#c7d3f5" stroke-width="4" stroke-dasharray="2 14" stroke-linecap="round"/>

          <g>
            <circle cx="60" cy="360" r="22" fill="#155eef"/>
            <path d="M60 351v18M52 360h16" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
          </g>
          <text x="94" y="366" font-family="Inter, Arial, sans-serif" font-size="14" font-weight="700" fill="#0f1729">Founded</text>

          <g>
            <circle cx="260" cy="260" r="22" fill="#7c3aed"/>
            <path d="M251 260h18M260 251v18" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
          </g>
          <text x="294" y="266" font-family="Inter, Arial, sans-serif" font-size="14" font-weight="700" fill="#0f1729">First Clients</text>

          <g>
            <circle cx="460" cy="160" r="22" fill="#10b981"/>
            <path d="M451 160h18M460 151v18" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
          </g>
          <text x="330" y="145" font-family="Inter, Arial, sans-serif" font-size="14" font-weight="700" fill="#0f1729">Team Growth</text>

          <g>
            <circle cx="500" cy="60" r="26" fill="#f59e0b"/>
            <path d="M500 46l4.5 9.2 10.1 1.5-7.3 7.1 1.7 10.1-9-4.8-9 4.8 1.7-10.1-7.3-7.1 10.1-1.5z" fill="#fff"/>
          </g>
          <text x="392" y="45" font-family="Inter, Arial, sans-serif" font-size="14" font-weight="700" fill="#0f1729">Today</text>
        </svg>
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
