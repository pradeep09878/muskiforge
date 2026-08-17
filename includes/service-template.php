<?php
/**
 * Shared layout for individual service pages under /services/.
 * Expects $service (see services/*.php for the shape) to already be in scope.
 */

declare(strict_types=1);

$serviceIndex = array_search($service['slug'], array_keys(services_catalog()), true);
$serviceTonal = tonal_vars($serviceIndex === false ? 0 : (int) $serviceIndex);
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= e(url('index.php')) ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= e(url('services.php')) ?>" class="text-decoration-none">Services</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= e($service['title']) ?></li>
          </ol>
        </nav>
        <span class="hero-badge mb-3"><i class="<?= e($service['icon']) ?>"></i> <?= e($service['title']) ?></span>
        <h1 class="mt-2 mb-3"><?= e($service['heading']) ?></h1>
        <p class="section-subtitle fs-5 mb-4"><?= e($service['intro']) ?></p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?= e(url('contact.php')) ?>" class="btn btn-accent btn-lg rounded-pill px-4">Get Started</a>
          <a href="<?= e(url('portfolio.php')) ?>" class="btn btn-outline-accent btn-lg rounded-pill px-4">View Our Work</a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="service-panel rounded-xl shadow-soft" style="background:<?= e($serviceTonal['bg']) ?>;color:<?= e($serviceTonal['fg']) ?>">
          <i class="<?= e($service['icon']) ?> service-panel-icon" aria-hidden="true"></i>
          <div class="service-panel-title"><?= e($service['title']) ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">What's Included</span>
      <h2 class="section-title mt-2 mb-3">Our <?= e($service['title']) ?> Capabilities</h2>
    </div>
    <div class="row g-4">
      <?php foreach ($service['features'] as $feature): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-service h-100">
          <div class="icon-badge"><i class="<?= e($feature['icon']) ?>"></i></div>
          <h3 class="h6 fw-bold mb-2"><?= e($feature['title']) ?></h3>
          <p class="section-subtitle mb-0"><?= e($feature['text']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 section-dark">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-6">
        <span class="eyebrow">Why It Matters</span>
        <h2 class="section-title mt-2 mb-3">The Business Impact</h2>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <?php foreach ($service['benefits'] as $benefit): ?>
          <li><i class="fa-solid fa-circle-check text-accent me-2"></i><?= e($benefit) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-6">
        <span class="eyebrow">Tools We Use</span>
        <h2 class="section-title mt-2 mb-3">Technologies</h2>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($service['technologies'] as $tech): ?>
          <span class="badge rounded-pill text-bg-light border px-3 py-2 fw-semibold"><?= e($tech) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" id="process">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">How We Work</span>
      <h2 class="section-title mt-2 mb-3">Our Process</h2>
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

<?php if (!empty($service['faqs'])): ?>
<section class="py-5 bg-light" id="faq">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width:640px">
      <span class="eyebrow">Questions</span>
      <h2 class="section-title mt-2 mb-3"><?= e($service['title']) ?> FAQs</h2>
    </div>
    <div class="accordion mx-auto" id="serviceFaqAccordion" style="max-width:840px">
      <?php foreach ($service['faqs'] as $i => $faq): ?>
      <div class="accordion-item">
        <h3 class="accordion-header" id="svcFaqHeading<?= $i ?>">
          <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#svcFaqCollapse<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="svcFaqCollapse<?= $i ?>">
            <?= e($faq['question']) ?>
          </button>
        </h3>
        <div id="svcFaqCollapse<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" aria-labelledby="svcFaqHeading<?= $i ?>" data-bs-parent="#serviceFaqAccordion">
          <div class="accordion-body section-subtitle"><?= e($faq['answer']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="py-5">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Ready to Talk <?= e($service['title']) ?>?</h2>
      <p class="mb-4 mx-auto" style="max-width:520px;opacity:.9">Book a free consultation and we'll map out the right approach for your goals and budget.</p>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Book a Consultation</a>
    </div>
  </div>
</section>

</main>
