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

$flagshipServices = [
    [
        'slug' => 'cloud-solutions',
        'bullets' => ['Cloud migration with zero-downtime cutover', 'Infrastructure-as-code environments', 'Ongoing monitoring and cost optimization'],
    ],
    [
        'slug' => 'software-development',
        'bullets' => ['Custom platforms built around your workflows', 'Secure, maintainable architecture from day one', 'PHP, Laravel, and Node.js engineering'],
    ],
    [
        'slug' => 'digital-marketing',
        'bullets' => ['Data-driven campaigns tied to real KPIs', 'SEO-informed content and channel strategy', 'Transparent reporting on what is working'],
    ],
];
$svc = services_catalog();

$extraSchema = schema_faq($faqs);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<!-- ============ HERO ============ -->
<section class="hero-kinetic">
  <div class="container text-center">
    <div class="hero-kinetic-badge">
      <span class="hero-kinetic-dot" aria-hidden="true"></span>
      IT Services &amp; Digital Solutions
    </div>
    <h1 class="hero-kinetic-title">Engineering the technology that scales your business.</h1>
    <p class="hero-kinetic-text">
      We design, build, and manage secure, scalable software, websites, and cloud infrastructure — with the
      reliability and craftsmanship of a senior engineering team, not a rotating cast of juniors.
    </p>
    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-5">
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-accent btn-lg rounded-pill px-4">Get a Free Consultation</a>
      <a href="<?= e(url('services.php')) ?>" class="btn-ghost-link">Explore Our Services <span aria-hidden="true">→</span></a>
    </div>

    <!-- Illustrative delivery-dashboard panel: a design device representing
         the kind of visibility we build for clients, populated with
         Muskiforge's own published figures (see the About page). -->
    <div class="hero-dashboard mx-auto text-start">
      <div class="hero-dashboard-topbar">
        <div class="d-flex align-items-center gap-3">
          <span class="hero-dashboard-live">
            <span class="hero-dashboard-ping" aria-hidden="true"></span>
            Delivery Dashboard
          </span>
          <span class="hero-dashboard-divider d-none d-sm-inline">/</span>
          <span class="hero-dashboard-muted d-none d-sm-inline">Muskiforge Engineering</span>
        </div>
        <span class="hero-dashboard-chip">Illustrative overview</span>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-sm-4">
          <div class="hero-dashboard-tile">
            <span class="hero-dashboard-tile-label">Client Satisfaction</span>
            <div class="hero-dashboard-tile-num">98%</div>
            <span class="hero-dashboard-tile-sub">Across delivered engagements</span>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="hero-dashboard-tile">
            <span class="hero-dashboard-tile-label">Projects Delivered</span>
            <div class="hero-dashboard-tile-num">150+</div>
            <span class="hero-dashboard-tile-sub">Since founding</span>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="hero-dashboard-tile">
            <span class="hero-dashboard-tile-label">Support Coverage</span>
            <div class="hero-dashboard-tile-num">24/7</div>
            <span class="hero-dashboard-tile-sub">Monitoring &amp; response</span>
          </div>
        </div>
      </div>

      <div class="hero-dashboard-chart">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="hero-dashboard-muted font-mono small">Client Growth Trajectory</span>
          <span class="hero-dashboard-muted font-mono small d-none d-sm-inline">Illustrative trend</span>
        </div>
        <svg class="w-100" viewBox="0 0 700 100" preserveAspectRatio="none" aria-hidden="true">
          <defs>
            <linearGradient id="heroChartGlow" x1="0" x2="0" y1="0" y2="1">
              <stop offset="0%" stop-color="#2563eb" stop-opacity=".18"/>
              <stop offset="100%" stop-color="#2563eb" stop-opacity="0"/>
            </linearGradient>
          </defs>
          <line x1="0" y1="25" x2="700" y2="25" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3 3"/>
          <line x1="0" y1="60" x2="700" y2="60" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="3 3"/>
          <path d="M0,80 C90,78 140,60 210,52 C280,44 330,64 400,40 C470,16 530,32 600,20 C650,12 680,16 700,10 L700,100 L0,100 Z" fill="url(#heroChartGlow)"/>
          <path d="M0,80 C90,78 140,60 210,52 C280,44 330,64 400,40 C470,16 530,32 600,20 C650,12 680,16 700,10" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round"/>
          <circle cx="600" cy="20" r="4" fill="#2563eb"/>
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- ============ TRUSTED BY ============ -->
<section class="py-5 border-bottom">
  <div class="container">
    <p class="text-center text-uppercase small fw-bold text-muted mb-4" style="letter-spacing:.1em">Trusted by growing teams across industries</p>
    <div class="row trusted-strip justify-content-center align-items-center gy-4">
      <?php foreach (['NovaHealth', 'Finlytics', 'EduSphere', 'CargoLine', 'BrightRetail', 'UrbanEstate'] as $brand): ?>
      <div class="col-4 col-md-2 text-center"><span class="brand-name fw-bold"><?= e($brand) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SERVICES (3 flagship categories) ============ -->
<section class="py-5 py-lg-6" id="services">
  <div class="container">
    <div class="mb-5" style="max-width:640px">
      <span class="eyebrow">Systemic Competencies</span>
      <h2 class="section-title mt-2 mb-3">Complete IT services under one roof.</h2>
      <p class="section-subtitle">Architectural rigor meets continuous delivery across every layer of your digital ecosystem.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($flagshipServices as $flagship): $s = $svc[$flagship['slug']]; ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service h-100 d-flex flex-column">
          <div class="icon-badge"><i class="<?= e($s['icon']) ?>"></i></div>
          <h3 class="h5 fw-bold mb-2"><?= e($s['title']) ?></h3>
          <p class="section-subtitle mb-3"><?= e($s['summary']) ?></p>
          <ul class="list-unstyled d-flex flex-column gap-2 mb-4 flex-grow-1">
            <?php foreach ($flagship['bullets'] as $bullet): ?>
            <li class="d-flex align-items-start gap-2 small">
              <span class="bullet-dot" aria-hidden="true"></span>
              <span><?= e($bullet) ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?= e(url('services/' . $flagship['slug'] . '.php')) ?>" class="fw-semibold service-card-link text-decoration-none">Learn more <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
      <a href="<?= e(url('services.php')) ?>" class="fw-semibold text-decoration-none">View all services <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>
  </div>
</section>

<!-- ============ WHY US (narrative + real metrics + photo) ============ -->
<section class="py-5 py-lg-6 section-dark" id="about">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <span class="eyebrow">Trusted Technology Partner</span>
        <h2 class="section-title mt-2 mb-3">Engineered by senior practitioners, not account managers.</h2>
        <p class="fs-5 fw-semibold mb-3">Technology should solve problems — not create them.</p>
        <p class="section-subtitle mb-3">
          At Muskiforge, we help businesses turn ideas into reliable digital products and scalable technology
          solutions. Whether you're launching a startup, modernizing legacy systems, improving online visibility,
          or automating operations, our team delivers solutions designed for measurable business growth.
        </p>
        <p class="section-subtitle mb-4">
          From strategy and planning to development, deployment, optimization, and ongoing support, we become an
          extension of your business — not just another service provider.
        </p>
        <div class="row g-3 metric-strip">
          <div class="col-4">
            <div class="metric-strip-num">150+</div>
            <div class="metric-strip-label">Projects Delivered</div>
          </div>
          <div class="col-4">
            <div class="metric-strip-num">98%</div>
            <div class="metric-strip-label">Client Satisfaction</div>
          </div>
          <div class="col-4">
            <div class="metric-strip-num">24/7</div>
            <div class="metric-strip-label">Support Available</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="why-us-photo">
          <img src="<?= e(asset('images/why-us-team.png')) ?>" alt="Muskiforge engineers reviewing a technical architecture together" class="w-100 h-100" loading="lazy">
          <div class="why-us-photo-overlay">
            <span class="hero-dashboard-dot" aria-hidden="true"></span>
            <span>Muskiforge Engineering Team</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ WHY CHOOSE MUSKIFORGE ============ -->
<section class="py-5 py-lg-6" id="why-us">
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
      foreach ($whyUs as $item): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-why">
          <div class="icon-badge"><i class="<?= e($item['icon']) ?>"></i></div>
          <h3 class="h6 fw-bold mb-2"><?= e($item['title']) ?></h3>
          <p class="section-subtitle mb-0"><?= e($item['text']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ DEVELOPMENT PROCESS ============ -->
<section class="py-5 py-lg-6 section-dark" id="process">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Our Process</span>
      <h2 class="section-title mt-2 mb-3">Our Development Process</h2>
    </div>
    <div class="row g-4">
      <?php foreach (process_steps() as $i => $step): ?>
      <div class="col-md-4 col-lg-2">
        <div class="process-step">
          <div class="step-num"><?= $i + 1 ?></div>
          <h3 class="h6 fw-bold mb-2"><?= e($step['title']) ?></h3>
          <p class="small section-subtitle mb-0"><?= e($step['desc']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
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
      <h2 class="mb-3" style="font-weight:700">Ready to Build Your Next Digital Solution?</h2>
      <p class="fs-5 mb-4 mx-auto" style="max-width:640px;opacity:.85">
        Whether you need a business website, enterprise software, mobile application, cloud infrastructure, or a
        complete digital marketing strategy, Muskiforge helps transform ideas into scalable digital products.
      </p>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-semibold">Start Your Project Today</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
