<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'IT Services Company | Software, Website & App Development | Muskiforge',
    'Muskiforge provides Website Development, Software Development, Mobile App Development, Cloud Solutions, SEO Services, Digital Marketing, and IT Consulting for businesses worldwide.',
    'index.php'
);

$faqs = [
    ['question' => 'What services does Muskiforge offer?', 'answer' => 'Muskiforge offers website development, custom software development, mobile app development, cloud solutions, SEO services, digital marketing, and IT consulting for startups, SMEs, and enterprises.'],
    ['question' => 'Which technologies does Muskiforge work with?', 'answer' => 'Our team builds with HTML5, CSS3, Bootstrap, React, and Angular on the frontend; PHP, Laravel, and Node.js on the backend; Flutter, Kotlin, and Swift for mobile; and AWS, Azure, and Google Cloud for infrastructure.'],
    ['question' => 'How long does a typical website or software project take?', 'answer' => 'Most marketing websites take 3-6 weeks, while custom software and mobile app projects typically run 8-16 weeks depending on scope. We provide a detailed timeline after the discovery phase.'],
    ['question' => 'Do you offer ongoing support after launch?', 'answer' => 'Yes. Every engagement includes a post-launch warranty period, and we offer 24/7 support and maintenance plans for hosting, security monitoring, and feature updates.'],
    ['question' => 'How is your development process structured?', 'answer' => 'We follow a seven-stage process: Discover, Plan, Design, Develop, Test, Launch, and Support, with regular checkpoints so you always know project status.'],
    ['question' => 'Can you help improve our search engine rankings?', 'answer' => 'Yes. Our SEO services cover technical SEO, on-page optimization, entity and semantic SEO, structured data, and content built for both traditional search engines and AI answer engines like ChatGPT, Gemini, and Perplexity.'],
    ['question' => 'Do you work with startups as well as enterprises?', 'answer' => 'Yes, Muskiforge works with early-stage startups, growing SMEs, and established enterprises, tailoring engagement models and pricing to each stage.'],
    ['question' => 'What industries do you have experience in?', 'answer' => 'We have delivered projects across healthcare, finance, education, logistics, manufacturing, retail, real estate, and technology startups.'],
    ['question' => 'How much does a project with Muskiforge cost?', 'answer' => 'Pricing depends on scope, complexity, and timeline. We provide a free consultation and a detailed proposal so you know costs upfront before any work begins.'],
    ['question' => 'Do you build mobile apps for both iOS and Android?', 'answer' => 'Yes. We build cross-platform apps with Flutter as well as native iOS apps in Swift and native Android apps in Kotlin, depending on your performance and budget needs.'],
    ['question' => 'Can you migrate our existing infrastructure to the cloud?', 'answer' => 'Yes, our cloud team plans and executes migrations to AWS, Azure, and Google Cloud, including containerization with Docker and Kubernetes and CI/CD pipeline setup.'],
    ['question' => 'How do we get started with Muskiforge?', 'answer' => 'Book a free consultation through our contact page. We will discuss your goals, review requirements, and follow up with a proposal and estimated timeline.'],
];

$extraSchema = schema_faq($faqs);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <span class="hero-badge mb-3"><i class="fa-solid fa-bolt"></i> Trusted Technology Partner</span>
        <h1 class="mb-4">Transforming Businesses Through Innovative Digital Solutions</h1>
        <p class="fs-5 section-subtitle mb-4">
          Muskiforge helps startups, SMEs, and enterprises accelerate growth with custom software development,
          website development, mobile applications, cloud solutions, SEO services, digital marketing, and
          strategic IT consulting.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?= e(url('contact.php')) ?>" class="btn btn-accent btn-lg rounded-pill px-4">Get Started</a>
          <a href="<?= e(url('services.php')) ?>" class="btn btn-outline-accent btn-lg rounded-pill px-4">Explore Services</a>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="<?= e(asset('images/hero-illustration.svg')) ?>" alt="Muskiforge digital solutions overview" class="img-fluid rounded-xl shadow-soft" loading="eager">
      </div>
    </div>
  </div>
</section>

<!-- ============ TRUSTED BY ============ -->
<section class="py-4 border-bottom">
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
        <span class="eyebrow">About Muskiforge</span>
        <h2 class="section-title mt-2 mb-3">A Trusted Digital Transformation Partner</h2>
        <p class="section-subtitle mb-4">
          Muskiforge is a full-service IT company that builds secure, scalable, and future-ready digital solutions
          tailored to your business needs. From your first line of code to long-term support, we combine deep
          technical expertise with a genuine stake in your growth — so every website, application, and campaign
          we ship is built to compound in value over time.
        </p>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <li><i class="fa-solid fa-circle-check text-accent me-2"></i>Senior engineers, not outsourced juniors</li>
          <li><i class="fa-solid fa-circle-check text-accent me-2"></i>Security and performance built in from day one</li>
          <li><i class="fa-solid fa-circle-check text-accent me-2"></i>Transparent process with weekly progress updates</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="py-5 py-lg-6 bg-light" id="services">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">What We Do</span>
      <h2 class="section-title mt-2 mb-3">End-to-End Services for Modern Businesses</h2>
      <p class="section-subtitle mx-auto">From your first landing page to enterprise-scale platforms, we cover the full digital lifecycle.</p>
    </div>
    <div class="row g-4">
      <?php foreach (services_catalog() as $slug => $service): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service bg-white">
          <div class="icon-badge"><i class="<?= e($service['icon']) ?>"></i></div>
          <h3 class="h5 fw-bold mb-2"><?= e($service['title']) ?></h3>
          <p class="section-subtitle mb-3"><?= e($service['summary']) ?></p>
          <a href="<?= e(url('services/' . $slug . '.php')) ?>" class="fw-semibold text-accent text-decoration-none">Learn More <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ WHY CHOOSE MUSKIFORGE ============ -->
<section class="py-5 py-lg-6" id="why-us">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Why Muskiforge</span>
      <h2 class="section-title mt-2 mb-3">Built Different, Built to Last</h2>
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
<section class="py-5 py-lg-6 bg-light" id="process">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">How We Work</span>
      <h2 class="section-title mt-2 mb-3">Our Development Process</h2>
    </div>
    <div class="row g-4">
      <?php foreach (['Discover', 'Plan', 'Design', 'Develop', 'Test', 'Launch', 'Support'] as $i => $step): ?>
      <div class="col-6 col-md-3 col-lg">
        <div class="process-step">
          <div class="step-num"><?= $i + 1 ?></div>
          <h3 class="h6 fw-bold mb-0"><?= e($step) ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TECHNOLOGIES ============ -->
<section class="py-5 py-lg-6" id="technologies">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Our Stack</span>
      <h2 class="section-title mt-2 mb-3">Technologies We Work With</h2>
    </div>
    <?php
    $techGroups = [
        'Frontend' => [['HTML5', 'fa-brands fa-html5'], ['CSS3', 'fa-brands fa-css3-alt'], ['Bootstrap', 'fa-brands fa-bootstrap'], ['React', 'fa-brands fa-react'], ['Angular', 'fa-brands fa-angular']],
        'Backend' => [['PHP', 'fa-brands fa-php'], ['Laravel', 'fa-brands fa-laravel'], ['Node.js', 'fa-brands fa-node-js']],
        'Mobile' => [['Flutter', 'fa-solid fa-mobile-screen'], ['Kotlin', 'fa-solid fa-mobile-screen'], ['Swift', 'fa-brands fa-swift']],
        'Cloud' => [['AWS', 'fa-brands fa-aws'], ['Azure', 'fa-brands fa-microsoft'], ['Google Cloud', 'fa-brands fa-google']],
        'Databases' => [['MySQL', 'fa-solid fa-database'], ['PostgreSQL', 'fa-solid fa-database'], ['MongoDB', 'fa-solid fa-database']],
        'DevOps' => [['Docker', 'fa-brands fa-docker'], ['Kubernetes', 'fa-solid fa-dharmachakra'], ['Git', 'fa-brands fa-git-alt'], ['Jenkins', 'fa-brands fa-jenkins']],
    ];
    foreach ($techGroups as $group => $items): ?>
    <div class="mb-4">
      <h3 class="h6 fw-bold text-uppercase text-muted mb-3"><?= e($group) ?></h3>
      <div class="row g-3">
        <?php foreach ($items as [$name, $icon]): ?>
        <div class="col-4 col-md-2">
          <div class="tech-badge"><i class="<?= e($icon) ?>"></i><?= e($name) ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============ INDUSTRIES ============ -->
<section class="py-5 py-lg-6 bg-light" id="industries">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Who We Serve</span>
      <h2 class="section-title mt-2 mb-3">Industries We Serve</h2>
    </div>
    <div class="row g-3 text-center">
      <?php
      $industries = [
          ['Healthcare', 'fa-solid fa-heart-pulse'], ['Finance', 'fa-solid fa-chart-line'],
          ['Education', 'fa-solid fa-graduation-cap'], ['Logistics', 'fa-solid fa-truck-fast'],
          ['Manufacturing', 'fa-solid fa-industry'], ['Retail', 'fa-solid fa-cart-shopping'],
          ['Startups', 'fa-solid fa-rocket'], ['Real Estate', 'fa-solid fa-building'],
      ];
      foreach ($industries as [$name, $icon]): ?>
      <div class="col-6 col-md-3">
        <div class="tech-badge bg-white"><i class="<?= e($icon) ?>"></i><?= e($name) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ PORTFOLIO ============ -->
<section class="py-5 py-lg-6" id="portfolio">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
      <div>
        <span class="eyebrow">Our Work</span>
        <h2 class="section-title mt-2 mb-0">Selected Projects</h2>
      </div>
      <a href="<?= e(url('portfolio.php')) ?>" class="fw-semibold text-accent text-decoration-none">View Full Portfolio <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4">
      <?php
      $projects = [
          ['NovaHealth Patient Portal', 'Web App', 'portfolio-1.jpg'],
          ['Finlytics Trading Dashboard', 'Enterprise Software', 'portfolio-2.jpg'],
          ['BrightRetail Storefront', 'E-commerce', 'portfolio-3.jpg'],
          ['CargoLine Fleet Tracker', 'Mobile App', 'portfolio-4.jpg'],
          ['EduSphere LMS Migration', 'Cloud Solutions', 'portfolio-5.jpg'],
          ['UrbanEstate Listings Platform', 'Web App', 'portfolio-6.jpg'],
      ];
      foreach ($projects as [$title, $tag, $img]): ?>
      <div class="col-md-6 col-lg-4">
        <div class="portfolio-card position-relative">
          <span class="portfolio-tag"><?= e($tag) ?></span>
          <img src="<?= e(asset('images/' . $img)) ?>" alt="<?= e($title) ?> case study" class="img-fluid w-100" loading="lazy">
        </div>
        <h3 class="h6 fw-bold mt-3 mb-0"><?= e($title) ?></h3>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="py-5 py-lg-6 bg-light" id="testimonials">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Client Voices</span>
      <h2 class="section-title mt-2 mb-3">What Our Clients Say</h2>
    </div>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $testimonials = [
            ['Muskiforge rebuilt our patient portal in under three months and our page load times dropped by 60%.', 'Amara Chen', 'CTO, NovaHealth'],
            ['Their SEO team took our organic traffic from flat to a 3x increase in under a year.', 'Daniel Osei', 'Head of Growth, BrightRetail'],
            ['The team felt like an extension of ours — clear communication and genuinely great engineering.', 'Priya Nair', 'Founder, EduSphere'],
        ];
        foreach ($testimonials as $i => [$quote, $name, $role]): ?>
        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
          <div class="testimonial-card mx-auto text-center" style="max-width:640px">
            <div class="testimonial-stars mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
            <p class="fs-5 fst-italic mb-4">"<?= e($quote) ?>"</p>
            <p class="fw-bold mb-0"><?= e($name) ?></p>
            <p class="section-subtitle"><?= e($role) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="d-flex justify-content-center gap-2 mt-4">
        <button class="btn btn-outline-accent btn-sm rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" aria-label="Previous testimonial"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="btn btn-outline-accent btn-sm rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" aria-label="Next testimonial"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </div>
  </div>
</section>

<!-- ============ STATISTICS ============ -->
<section class="py-5 py-lg-6 stats-section">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3">
        <div class="stat-number"><span data-counter="150" data-suffix="+">0+</span></div>
        <p class="stat-label mb-0">Projects Delivered</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-number"><span data-counter="98" data-suffix="%">0%</span></div>
        <p class="stat-label mb-0">Client Satisfaction</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-number"><span data-counter="50" data-suffix="+">0+</span></div>
        <p class="stat-label mb-0">Happy Clients</p>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-number">24/7</div>
        <p class="stat-label mb-0">Support</p>
      </div>
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

<!-- ============ BLOG PREVIEW ============ -->
<section class="py-5 py-lg-6 bg-light" id="blog-preview">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
      <div>
        <span class="eyebrow">Insights</span>
        <h2 class="section-title mt-2 mb-0">From the Blog</h2>
      </div>
      <a href="<?= e(url('blog.php')) ?>" class="fw-semibold text-accent text-decoration-none">Visit Blog <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4">
      <?php
      $posts = [
          ['Entity SEO in 2026: Building Topical Authority That AI Engines Cite', 'SEO', 'blog-1.jpg'],
          ['Choosing Between Laravel and Node.js for Your Next Platform', 'Software Development', 'blog-2.jpg'],
          ['Flutter vs Native: A Practical Guide for Startups', 'Mobile', 'blog-3.jpg'],
      ];
      foreach ($posts as [$title, $tag, $img]): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service bg-white p-0 overflow-hidden">
          <img src="<?= e(asset('images/' . $img)) ?>" alt="<?= e($title) ?>" class="img-fluid w-100" loading="lazy">
          <div class="p-4">
            <span class="eyebrow"><?= e($tag) ?></span>
            <h3 class="h6 fw-bold mt-2 mb-2"><?= e($title) ?></h3>
            <a href="<?= e(url('blog.php')) ?>" class="fw-semibold text-accent text-decoration-none">Read More <i class="fa-solid fa-arrow-right ms-1"></i></a>
          </div>
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
      <h2 class="fw-800 mb-3" style="font-weight:800">Ready to Build Something That Lasts?</h2>
      <p class="fs-5 mb-4 mx-auto" style="max-width:560px;opacity:.9">Start a project, book a free consultation, or just say hello — our team responds within one business day.</p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Start a Project</a>
        <a href="<?= e(url('contact.php')) ?>#consultation" class="btn btn-outline-light btn-lg rounded-pill px-4">Book a Consultation</a>
      </div>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
