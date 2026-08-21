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

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<!-- ============ HERO CAROUSEL ============ -->
<section class="hero-carousel-section" aria-label="Introduction">
  <svg class="hero-carousel-texture" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <pattern id="heroDots" width="34" height="34" patternUnits="userSpaceOnUse">
        <circle cx="2" cy="2" r="1.3" fill="rgba(255,255,255,.16)"/>
      </pattern>
    </defs>
    <rect width="100%" height="100%" fill="url(#heroDots)"/>
  </svg>
  <div class="hero-glow hero-glow-1" aria-hidden="true"></div>
  <div class="hero-glow hero-glow-2" aria-hidden="true"></div>

  <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" tabindex="0" aria-roledescription="carousel" aria-label="Featured highlights">
    <div class="carousel-inner">
      <?php foreach (hero_slides() as $i => $slide): ?>
      <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>" data-bs-interval="6500">
        <div class="hero-slide-art hero-slide-art--<?= e($slide['art']) ?>" aria-hidden="true">
          <?php if ($slide['art'] === 'network'): ?>
            <svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
              <line x1="45" y1="24" x2="270" y2="90" stroke="#fff" stroke-width="1"/>
              <line x1="270" y1="90" x2="15" y2="210" stroke="#fff" stroke-width="1"/>
              <line x1="15" y1="210" x2="225" y2="270" stroke="#fff" stroke-width="1"/>
              <line x1="225" y1="270" x2="135" y2="144" stroke="#fff" stroke-width="1"/>
              <line x1="135" y1="144" x2="45" y2="24" stroke="#fff" stroke-width="1"/>
              <line x1="135" y1="144" x2="270" y2="90" stroke="#fff" stroke-width="1"/>
            </svg>
            <span class="art-node"></span><span class="art-node"></span><span class="art-node"></span>
            <span class="art-node"></span><span class="art-node"></span>
          <?php elseif ($slide['art'] === 'glass'): ?>
            <span class="art-card"><i class="fa-solid fa-window-restore" aria-hidden="true"></i></span>
            <span class="art-card"><i class="fa-solid fa-database" aria-hidden="true"></i></span>
            <span class="art-card"><i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i></span>
          <?php else: ?>
            <span class="art-ring"></span><span class="art-ring"></span><span class="art-ring"></span>
            <i class="fa-solid fa-shield-halved art-shield-icon" aria-hidden="true"></i>
            <i class="fa-solid fa-server art-orbit-icon" aria-hidden="true"></i>
            <i class="fa-solid fa-cloud art-orbit-icon" aria-hidden="true"></i>
            <i class="fa-solid fa-chart-line art-orbit-icon" aria-hidden="true"></i>
          <?php endif; ?>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <span class="hero-eyebrow"><?= e($slide['eyebrow']) ?></span>
              <h1 class="hero-slide-title"><?= e($slide['title']) ?></h1>
              <p class="hero-slide-text"><?= e($slide['text']) ?></p>
              <div class="hero-slide-ctas">
                <a href="<?= e(url($slide['primary']['url'])) ?>" class="btn-hero-primary"><?= e($slide['primary']['label']) ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                <a href="<?= e(url($slide['secondary']['url'])) ?>" class="btn-hero-secondary"><?= e($slide['secondary']['label']) ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <button class="hero-carousel-control hero-carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
      <span class="visually-hidden">Previous slide</span>
    </button>
    <button class="hero-carousel-control hero-carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
      <span class="visually-hidden">Next slide</span>
    </button>

    <div class="carousel-indicators hero-carousel-indicators">
      <?php foreach (hero_slides() as $i => $slide): ?>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Show slide <?= $i + 1 ?>: <?= e($slide['title']) ?>"></button>
      <?php endforeach; ?>
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

<!-- ============ ABOUT ============ -->
<section class="py-5 py-lg-6 mt-4" id="about">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <div class="stat-panel h-100 d-flex flex-column justify-content-center">
          <div class="row g-4">
            <div class="col-6">
              <div class="stat-panel-num">150+</div>
              <div class="stat-panel-label">Projects Delivered</div>
            </div>
            <div class="col-6">
              <div class="stat-panel-num">98%</div>
              <div class="stat-panel-label">Client Satisfaction</div>
            </div>
            <div class="col-6">
              <div class="stat-panel-num">50+</div>
              <div class="stat-panel-label">Businesses Served</div>
            </div>
            <div class="col-6">
              <div class="stat-panel-num">24/7</div>
              <div class="stat-panel-label">Support Available</div>
            </div>
          </div>
        </div>
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
