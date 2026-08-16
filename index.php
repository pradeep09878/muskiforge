<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'IT Services Company | Software, Website & App Development | Muskiforge',
    'Muskiforge provides website development, software development, mobile app development, cloud solutions, SEO services, digital marketing, and IT consulting to help businesses grow through modern technology.',
    'index.php'
);

$faqs = [
    ['question' => 'What IT services does Muskiforge provide?', 'answer' => 'We offer website development, software development, mobile app development, cloud solutions, SEO services, digital marketing, and IT consulting for businesses of all sizes.'],
    ['question' => 'Do you build custom software?', 'answer' => 'Yes. Every software solution is developed according to your business requirements rather than using generic templates.'],
    ['question' => 'Can you improve my Google rankings?', 'answer' => "Our SEO services focus on technical optimization, content strategy, keyword research, local SEO, and long-term organic growth following Google's best practices."],
    ['question' => 'Do you work with startups?', 'answer' => 'Yes. We work with startups, SMEs, and enterprises, providing scalable technology solutions based on their growth stage and business goals.'],
    ['question' => 'Do you provide ongoing support?', 'answer' => 'Yes. We offer maintenance, performance optimization, updates, monitoring, and technical support after project delivery.'],
];

$extraSchema = schema_faq($faqs);

$heroSlides = [
    [
        'gradient' => ['#0f766e', '#06b6d4'],
        'badge' => 'Agile Software Development',
        'title' => 'Build <span class="hc-gradient-text">Powerful</span><br>Custom Software',
        'desc' => 'From internal tools to enterprise platforms — we design and develop software that solves real problems and scales with your business.',
        'primary' => ['label' => 'Software Services', 'icon' => 'fa-solid fa-code', 'url' => 'services/software-development.php'],
        'secondary' => ['label' => 'Start a Project', 'icon' => 'fa-solid fa-rocket', 'url' => 'contact.php'],
        'stats' => [
            ['num' => '150', 'suffix' => '+', 'label' => 'Projects Delivered'],
            ['num' => '50', 'suffix' => '+', 'label' => 'Technologies Used'],
            ['num' => '98', 'suffix' => '%', 'label' => 'On-Time Delivery'],
        ],
        'visual' => [
            'type' => 'code',
            'icon' => 'fa-solid fa-terminal',
            'title' => 'muskiforge-app/src/main.js',
            'sub' => 'Build pipeline',
            'live' => true,
            'lines' => [
                '<span class="c1">const</span> <span class="c2">app</span> <span class="c3">=</span> <span class="c4">await</span> <span class="c5">buildApp</span><span class="c3">({</span>',
                '&nbsp;&nbsp;<span class="c2">client</span><span class="c3">:</span> <span class="c4">\'NovaHealth\'</span><span class="c3">,</span>',
                '&nbsp;&nbsp;<span class="c2">stack</span><span class="c3">:</span> <span class="c4">\'React + Node + AWS\'</span><span class="c3">,</span>',
                '&nbsp;&nbsp;<span class="c2">timeline</span><span class="c3">:</span> <span class="c4">\'8 weeks\'</span>',
                '<span class="c3">});</span>',
                '<span class="c6">// build successful — deployed to prod</span>',
            ],
        ],
        'float' => [
            ['icon' => 'fa-solid fa-check-double', 'color' => '#34d399', 'title' => 'All Tests Passed', 'sub' => '248/248 specs'],
            ['icon' => 'fa-solid fa-gauge-high', 'color' => '#60a5fa', 'title' => 'Performance A+', 'sub' => 'Lighthouse 98/100'],
        ],
    ],
    [
        'gradient' => ['#1e3a8a', '#0ea5e9'],
        'badge' => 'Cloud Infrastructure Experts',
        'title' => 'Power Your <span class="hc-gradient-text">Cloud</span><br>Journey with Muskiforge',
        'desc' => 'Migrate, modernize, and manage your infrastructure on AWS, Azure, and Google Cloud — built for uptime and cost efficiency.',
        'primary' => ['label' => 'Cloud Services', 'icon' => 'fa-solid fa-cloud', 'url' => 'services/cloud-solutions.php'],
        'secondary' => ['label' => 'Get a Quote', 'icon' => 'fa-solid fa-comments', 'url' => 'contact.php'],
        'stats' => [
            ['num' => '50', 'suffix' => '+', 'label' => 'Cloud Migrations'],
            ['num' => '99.9', 'suffix' => '%', 'label' => 'Uptime Target'],
            ['num' => '40', 'suffix' => '%', 'label' => 'Avg Cost Reduction'],
        ],
        'visual' => [
            'type' => 'bars',
            'icon' => 'fa-solid fa-cloud',
            'title' => 'Multi-Cloud Dashboard',
            'sub' => 'AWS · Azure · GCP',
            'live' => true,
            'bars' => [
                ['label' => 'AWS Workloads', 'pct' => 88, 'color' => 'linear-gradient(90deg,#f59e0b,#fbbf24)'],
                ['label' => 'Azure Services', 'pct' => 74, 'color' => 'linear-gradient(90deg,#3b82f6,#60a5fa)'],
                ['label' => 'GCP Resources', 'pct' => 62, 'color' => 'linear-gradient(90deg,#10b981,#34d399)'],
            ],
        ],
        'float' => [
            ['icon' => 'fa-solid fa-circle-check', 'color' => '#34d399', 'title' => 'Migration Complete', 'sub' => 'Zero downtime achieved'],
            ['icon' => 'fa-solid fa-bolt', 'color' => '#f59e0b', 'title' => '40% Faster', 'sub' => 'Performance boost'],
        ],
    ],
    [
        'gradient' => ['#065f46', '#10b981'],
        'badge' => 'Data-Driven SEO',
        'title' => 'Grow Your <span class="hc-gradient-text">Organic</span><br>Search Visibility',
        'desc' => 'Technical SEO, content strategy, and AI-search optimization that compounds — built for Google, Bing, and AI answer engines.',
        'primary' => ['label' => 'SEO Services', 'icon' => 'fa-solid fa-magnifying-glass-chart', 'url' => 'services/seo-services.php'],
        'secondary' => ['label' => 'Free SEO Audit', 'icon' => 'fa-solid fa-clipboard-check', 'url' => 'contact.php'],
        'stats' => [
            ['num' => '3', 'suffix' => 'x', 'label' => 'Avg Traffic Growth'],
            ['num' => '200', 'suffix' => '+', 'label' => 'Keywords Ranked'],
            ['num' => '98', 'suffix' => '%', 'label' => 'Client Retention'],
        ],
        'visual' => [
            'type' => 'grid',
            'icon' => 'fa-solid fa-chart-line',
            'title' => 'SEO Performance',
            'sub' => 'Last 90 days',
            'live' => true,
            'tiles' => [
                ['icon' => 'fa-solid fa-arrow-trend-up', 'color' => '#34d399', 'val' => '+186%', 'lbl' => 'Organic Traffic'],
                ['icon' => 'fa-solid fa-key', 'color' => '#a78bfa', 'val' => '214', 'lbl' => 'Keywords Ranked'],
                ['icon' => 'fa-solid fa-link', 'color' => '#60a5fa', 'val' => '340', 'lbl' => 'Backlinks Earned'],
                ['icon' => 'fa-solid fa-gauge-high', 'color' => '#f59e0b', 'val' => '98/100', 'lbl' => 'Core Web Vitals'],
            ],
        ],
        'float' => [
            ['icon' => 'fa-solid fa-ranking-star', 'color' => '#34d399', 'title' => 'Ranking Improved', 'sub' => '+12 positions this month'],
            ['icon' => 'fa-solid fa-robot', 'color' => '#a78bfa', 'title' => 'AI Search Ready', 'sub' => 'Structured for AI Overviews'],
        ],
    ],
    [
        'gradient' => ['#1c1917', '#b45309'],
        'badge' => 'Strategic IT Advisory',
        'title' => 'Transform Your<br>Business with <span class="hc-gradient-text">Expert Guidance</span>',
        'desc' => 'Our consultants build technology roadmaps aligned with your business goals — helping you invest smarter and move faster.',
        'primary' => ['label' => 'Our Consulting', 'icon' => 'fa-solid fa-lightbulb', 'url' => 'services/it-consulting.php'],
        'secondary' => ['label' => 'Book a Session', 'icon' => 'fa-solid fa-calendar', 'url' => 'contact.php'],
        'stats' => [
            ['num' => '50', 'suffix' => '+', 'label' => 'Roadmaps Built'],
            ['num' => '30', 'suffix' => '%', 'label' => 'Avg IT Savings'],
            ['num' => '24/7', 'suffix' => '', 'label' => 'Advisory Access'],
        ],
        'visual' => [
            'type' => 'progress',
            'icon' => 'fa-solid fa-chart-pie',
            'title' => 'IT Transformation Plan',
            'sub' => 'Quarterly roadmap',
            'live' => false,
            'rows' => [
                ['label' => 'Infrastructure Audit', 'pct' => 100, 'color' => '#34d399'],
                ['label' => 'Cloud Migration Phase 1', 'pct' => 68, 'color' => '#60a5fa'],
                ['label' => 'Security Hardening', 'pct' => 40, 'color' => '#f59e0b'],
                ['label' => 'Digital Transformation', 'pct' => 15, 'color' => '#a78bfa'],
            ],
        ],
        'float' => [
            ['icon' => 'fa-solid fa-flag-checkered', 'color' => '#f59e0b', 'title' => 'Roadmap Delivered', 'sub' => 'Within 4 weeks'],
            ['icon' => 'fa-solid fa-users', 'color' => '#60a5fa', 'title' => 'Senior Consultants', 'sub' => 'No outsourced juniors'],
        ],
    ],
    [
        'gradient' => ['#1e1b4b', '#7c3aed'],
        'badge' => 'iOS, Android & Cross-Platform',
        'title' => 'Launch Apps Your <span class="hc-gradient-text">Users</span><br>Actually Love',
        'desc' => 'Native and cross-platform mobile apps engineered for performance, security, and a seamless user experience.',
        'primary' => ['label' => 'Mobile App Services', 'icon' => 'fa-solid fa-mobile-screen-button', 'url' => 'services/mobile-app-development.php'],
        'secondary' => ['label' => 'Start Your App', 'icon' => 'fa-solid fa-rocket', 'url' => 'contact.php'],
        'stats' => [
            ['num' => '40', 'suffix' => '+', 'label' => 'Apps Shipped'],
            ['num' => '2', 'suffix' => '', 'label' => 'Platforms Covered'],
            ['num' => '100', 'suffix' => '%', 'label' => 'Native Performance'],
        ],
        'visual' => [
            'type' => 'grid',
            'icon' => 'fa-solid fa-mobile-screen',
            'title' => 'App Health Monitor',
            'sub' => 'Production build',
            'live' => true,
            'tiles' => [
                ['icon' => 'fa-solid fa-shield-heart', 'color' => '#34d399', 'val' => '99.8%', 'lbl' => 'Crash-Free Sessions'],
                ['icon' => 'fa-solid fa-download', 'color' => '#60a5fa', 'val' => '4.6★', 'lbl' => 'Avg Store Rating'],
                ['icon' => 'fa-solid fa-bolt', 'color' => '#f59e0b', 'val' => '1.2s', 'lbl' => 'Cold Start Time'],
                ['icon' => 'fa-solid fa-code-branch', 'color' => '#a78bfa', 'val' => '1', 'lbl' => 'Shared Codebase'],
            ],
        ],
        'float' => [
            ['icon' => 'fa-solid fa-store', 'color' => '#34d399', 'title' => 'Store Ready', 'sub' => 'Approved first submission'],
            ['icon' => 'fa-solid fa-layer-group', 'color' => '#60a5fa', 'title' => 'Built with Flutter', 'sub' => 'One codebase, both platforms'],
        ],
    ],
];

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<!-- ============ MOBILE HERO (small/medium screens only) ============ -->
<!-- The desktop carousel below (dashboard visuals, floating cards, tilt
     effects) is built for a wide viewport. Below the lg breakpoint we show
     this simpler, static hero instead — same brand voice, no JS dependency. -->
<section class="hero d-lg-none">
  <div class="container">
    <div class="text-center mx-auto" style="max-width:640px">
      <span class="hero-badge mb-3"><i class="fa-solid fa-bolt"></i> Trusted Technology Partner</span>
      <h1 class="mb-4">End-to-End IT Services That Help Businesses <span class="text-gradient">Build, Scale &amp; Grow</span></h1>
      <p class="fs-5 section-subtitle mx-auto mb-4">
        Muskiforge delivers custom software development, website development, mobile app development, cloud
        solutions, SEO services, digital marketing, and IT consulting to help startups, SMEs, and enterprises
        accelerate digital transformation.
      </p>
      <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-4">
        <a href="<?= e(url('contact.php')) ?>" class="btn btn-accent btn-lg rounded-pill px-4">Get Started</a>
        <a href="<?= e(url('portfolio.php')) ?>" class="btn btn-outline-accent btn-lg rounded-pill px-4">View Our Work</a>
      </div>
      <div class="hero-proof justify-content-center">
        <i class="fa-solid fa-circle-check text-accent"></i>
        <p class="small text-muted mb-0"><strong class="text-dark">150+</strong> projects delivered &middot; <strong class="text-dark">98%</strong> client satisfaction</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ DESKTOP HERO CAROUSEL (lg and up) ============ -->
<section class="hero-carousel d-none d-lg-block" id="heroCarousel" data-hero-carousel>
  <?php foreach ($heroSlides as $i => $slide): ?>
  <div class="hc-slide<?= $i === 0 ? ' active' : '' ?>" style="--slide-from:<?= e($slide['gradient'][0]) ?>;--slide-to:<?= e($slide['gradient'][1]) ?>">
    <div class="hc-grid-overlay"></div>
    <div class="hc-blob hc-blob-1"></div>
    <div class="hc-blob hc-blob-2"></div>
    <i class="hc-watermark <?= e($slide['visual']['icon']) ?>" aria-hidden="true"></i>
    <div class="container hc-inner">
      <div class="hc-content">
        <div class="hc-badge"><span class="hc-dot-pulse"></span> <?= e($slide['badge']) ?></div>
        <h1 class="hc-title"><?= $slide['title'] ?></h1>
        <p class="hc-desc"><?= e($slide['desc']) ?></p>
        <div class="hc-btns">
          <a href="<?= e(url($slide['primary']['url'])) ?>" class="hc-btn-white"><i class="<?= e($slide['primary']['icon']) ?>"></i> <?= e($slide['primary']['label']) ?></a>
          <a href="<?= e(url($slide['secondary']['url'])) ?>" class="hc-btn-outline"><i class="<?= e($slide['secondary']['icon']) ?>"></i> <?= e($slide['secondary']['label']) ?></a>
        </div>
        <div class="hc-stats">
          <?php foreach ($slide['stats'] as $si => $stat): ?>
          <?php if ($si > 0): ?><div class="hc-stat-div"></div><?php endif; ?>
          <?php $isNumeric = (bool) preg_match('/^\d+(\.\d+)?$/', (string) $stat['num']); ?>
          <div class="hc-stat">
            <span class="hc-stat-num"><span class="hc-stat-value"<?= $isNumeric ? ' data-hero-count="' . e($stat['num']) . '"' : '' ?>><?= e($stat['num']) ?></span><sup><?= e($stat['suffix']) ?></sup></span>
            <span class="hc-stat-label"><?= e($stat['label']) ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="hc-visual">
        <div class="hc-card">
          <div class="hc-card-head">
            <div class="hc-card-icon"><i class="<?= e($slide['visual']['icon']) ?>"></i></div>
            <div><div class="hc-card-title"><?= e($slide['visual']['title']) ?></div><div class="hc-card-sub"><?= e($slide['visual']['sub']) ?></div></div>
            <?php if ($slide['visual']['live']): ?><span class="hc-live-badge"><i class="fa-solid fa-circle" style="font-size:.5rem"></i> Live</span><?php endif; ?>
          </div>

          <?php if ($slide['visual']['type'] === 'bars'): ?>
            <?php foreach ($slide['visual']['bars'] as $bar): ?>
            <div class="hc-bar-row">
              <span><?= e($bar['label']) ?></span>
              <div class="hc-bar-track"><div class="hc-bar-fill" style="width:<?= (int) $bar['pct'] ?>%;background:<?= e($bar['color']) ?>"></div></div>
              <span><?= (int) $bar['pct'] ?>%</span>
            </div>
            <?php endforeach; ?>

          <?php elseif ($slide['visual']['type'] === 'grid'): ?>
            <div class="hc-stat-grid">
              <?php foreach ($slide['visual']['tiles'] as $tile): ?>
              <div class="hc-stat-tile">
                <i class="<?= e($tile['icon']) ?>" style="color:<?= e($tile['color']) ?>"></i>
                <div class="val"><?= e($tile['val']) ?></div>
                <div class="lbl"><?= e($tile['lbl']) ?></div>
              </div>
              <?php endforeach; ?>
            </div>

          <?php elseif ($slide['visual']['type'] === 'code'): ?>
            <div class="hc-code">
              <?php foreach ($slide['visual']['lines'] as $line): ?>
              <div><?= $line ?></div>
              <?php endforeach; ?>
            </div>

          <?php elseif ($slide['visual']['type'] === 'progress'): ?>
            <?php foreach ($slide['visual']['rows'] as $row): ?>
            <div class="hc-progress-row">
              <div class="hc-progress-labels"><span><?= e($row['label']) ?></span><strong><?= (int) $row['pct'] ?>%</strong></div>
              <div class="hc-progress-track"><div class="hc-progress-fill" style="width:<?= (int) $row['pct'] ?>%;background:<?= e($row['color']) ?>"></div></div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <?php foreach ($slide['float'] as $fi => $float): ?>
        <div class="hc-float hc-float-<?= $fi === 0 ? 'tl' : 'br' ?>">
          <i class="<?= e($float['icon']) ?>" style="color:<?= e($float['color']) ?>;font-size:1.1rem"></i>
          <div><div class="hc-float-title"><?= e($float['title']) ?></div><div class="hc-float-sub"><?= e($float['sub']) ?></div></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <button type="button" class="hc-arrow hc-arrow-prev" data-hero-prev aria-label="Previous slide"><i class="fa-solid fa-chevron-left"></i></button>
  <button type="button" class="hc-arrow hc-arrow-next" data-hero-next aria-label="Next slide"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="hc-nav" data-hero-nav>
    <?php foreach ($heroSlides as $i => $slide): ?>
    <button type="button" class="hc-nav-dot<?= $i === 0 ? ' active' : '' ?>" data-hero-goto="<?= $i ?>" aria-label="Go to slide <?= $i + 1 ?>"><span class="hc-nav-fill"></span></button>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============ TRUSTED BY ============ -->
<section class="py-4">
  <div class="container">
    <p class="text-center text-uppercase small fw-bold text-muted mb-4">Trusted by growing teams across industries</p>
    <div class="row trusted-strip justify-content-center align-items-center gy-3">
      <?php foreach (['NovaHealth', 'Finlytics', 'EduSphere', 'CargoLine', 'BrightRetail', 'UrbanEstate'] as $brand): ?>
      <div class="col-4 col-md-2 text-center fw-bold text-secondary"><?= e($brand) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="py-5 py-lg-6 mt-4" id="about">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <img src="<?= e(asset('images/about-team.jpg')) ?>" alt="Muskiforge engineering and design team collaborating" class="img-fluid rounded-xl shadow-soft" loading="lazy">
      </div>
      <div class="col-lg-6">
        <span class="eyebrow">Trusted Technology Partner</span>
        <h2 class="section-title mt-2 mb-3">Digital Solutions Built Around Your Business Goals</h2>
        <p class="fs-5 fw-semibold mb-3">Technology should solve problems—not create them.</p>
        <p class="section-subtitle mb-3">
          At Muskiforge, we help businesses turn ideas into reliable digital products and scalable technology
          solutions. Whether you're launching a startup, modernizing legacy systems, improving online visibility,
          or automating operations, our team delivers solutions designed for measurable business growth.
        </p>
        <p class="section-subtitle mb-0">
          From strategy and planning to development, deployment, optimization, and ongoing support, we become an
          extension of your business—not just another service provider.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="py-5 py-lg-6 bg-light" id="services">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Our Services</span>
      <h2 class="section-title mt-2 mb-3">Complete IT Services Under One Roof</h2>
    </div>
    <div class="row g-4">
      <?php $si = 0; foreach (services_catalog() as $slug => $service): $accent = accent_class($si); ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service <?= e($accent) ?>">
          <div class="icon-badge <?= e($accent) ?>"><i class="<?= e($service['icon']) ?>"></i></div>
          <h3 class="h5 fw-bold mb-2"><?= e($service['title']) ?></h3>
          <p class="section-subtitle mb-3"><?= e($service['summary']) ?></p>
          <a href="<?= e(url('services/' . $slug . '.php')) ?>" class="fw-semibold service-card-link text-decoration-none">Learn More <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>
      <?php $si++; endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ WHY CHOOSE MUSKIFORGE ============ -->
<section class="py-5 py-lg-6 section-dark" id="why-us">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:680px">
      <span class="eyebrow">Why Choose Muskiforge?</span>
      <h2 class="section-title mt-2 mb-3">Why Businesses Choose Muskiforge</h2>
      <p class="fw-semibold mb-2">Every business has different challenges.</p>
      <p class="fw-semibold mb-3">That's why we don't sell predefined packages.</p>
      <p class="section-subtitle mx-auto mb-2">
        We analyze your goals, understand your processes, and recommend technology that creates measurable value.
      </p>
      <p class="section-subtitle mx-auto mb-0">
        Our approach combines technical expertise, strategic thinking, and transparent communication to deliver
        solutions that are scalable, secure, and future-ready.
      </p>
    </div>
    <div class="row g-4">
      <?php
      $whyUs = [
          ['icon' => 'fa-solid fa-user-gear', 'title' => 'Experienced Developers', 'text' => 'Senior engineers with years of production experience, not a rotating cast of juniors.'],
          ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Secure Solutions', 'text' => 'Security best practices baked into every layer, from code to infrastructure.'],
          ['icon' => 'fa-solid fa-arrows-spin', 'title' => 'Agile Development', 'text' => 'Iterative sprints with regular demos, so you see progress every step of the way.'],
          ['icon' => 'fa-solid fa-cloud-arrow-up', 'title' => 'Cloud Expertise', 'text' => 'Deep experience across AWS, Azure, and Google Cloud infrastructure and DevOps.'],
          ['icon' => 'fa-solid fa-magnifying-glass-chart', 'title' => 'SEO-Driven Approach', 'text' => 'Every site we ship is engineered for search visibility from day one, not bolted on after.'],
          ['icon' => 'fa-solid fa-headset', 'title' => '24/7 Support', 'text' => 'Round-the-clock monitoring and support so issues get resolved before they cost you.'],
      ];
      foreach ($whyUs as $wi => $item): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-why">
          <div class="icon-badge <?= e(accent_class($wi)) ?>"><i class="<?= e($item['icon']) ?>"></i></div>
          <h3 class="h6 fw-bold mb-2"><?= e($item['title']) ?></h3>
          <p class="section-subtitle mb-0"><?= e($item['text']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ DEVELOPMENT PROCESS ============ -->
<section class="py-5 py-lg-6" id="process">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Our Process</span>
      <h2 class="section-title mt-2 mb-3">Our Development Process</h2>
    </div>
    <div class="row g-4">
      <?php foreach (process_steps() as $i => $step): ?>
      <div class="col-md-4 col-lg-2">
        <div class="process-step">
          <div class="step-num <?= e(accent_class($i)) ?>"><?= $i + 1 ?></div>
          <h3 class="h6 fw-bold mb-2"><?= e($step['title']) ?></h3>
          <p class="small section-subtitle mb-0"><?= e($step['desc']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ RESULTS THAT MATTER ============ -->
<section class="py-5 py-lg-6 section-dark" id="results">
  <div class="container">
    <div class="text-center mx-auto" style="max-width:720px">
      <span class="eyebrow">Results That Matter</span>
      <h2 class="section-title mt-2 mb-4">Technology Designed for Long-Term Growth</h2>
      <p class="fs-5 fw-semibold mb-3">A successful digital solution is more than attractive design.</p>
      <p class="section-subtitle mx-auto fs-5 mb-3">
        It should improve efficiency, strengthen customer experience, generate revenue, and support business
        expansion.
      </p>
      <p class="section-subtitle mx-auto fs-5 mb-0">
        Every project we deliver is built with performance, security, scalability, and search visibility in mind.
      </p>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="py-5 py-lg-6" id="faq">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Questions</span>
      <h2 class="section-title mt-2 mb-3">Frequently Asked Questions</h2>
    </div>
    <div class="accordion mx-auto" id="faqAccordion" style="max-width:840px">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="accordion-item">
        <h3 class="accordion-header" id="faqHeading<?= $i ?>">
          <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faqCollapse<?= $i ?>">
            <?= e($faq['question']) ?>
          </button>
        </h3>
        <div id="faqCollapse<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" aria-labelledby="faqHeading<?= $i ?>" data-bs-parent="#faqAccordion">
          <div class="accordion-body section-subtitle"><?= e($faq['answer']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="py-5">
  <div class="container">
    <div class="cta-section text-center px-4 py-5 py-md-6">
      <h2 class="mb-3" style="font-weight:800">Ready to Build Your Next Digital Solution?</h2>
      <p class="fs-5 mb-4 mx-auto" style="max-width:640px;opacity:.9">
        Whether you need a business website, enterprise software, mobile application, cloud infrastructure, or a
        complete digital marketing strategy, Muskiforge helps transform ideas into scalable digital products.
      </p>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Start Your Project Today</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
