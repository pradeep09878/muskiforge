<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Contact Muskiforge | Start a Project or Book a Consultation',
    'Get in touch with Muskiforge to start a project, book a free consultation, or ask about our website, software, mobile app, cloud, SEO, and marketing services.',
    'contact.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Contact', 'url' => url('contact.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Get In Touch</span>
    <h1 class="section-title mt-2 mb-3">Let's Start a Conversation</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">
      Tell us about your project and we'll respond within one business day.
    </p>
  </div>
</section>

<section class="py-5" id="consultation">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-5">
        <h2 class="h4 fw-bold mb-4">Contact Information</h2>
        <ul class="list-unstyled d-flex flex-column gap-3">
          <li class="d-flex gap-3">
            <span class="icon-badge flex-shrink-0"><i class="fa-solid fa-envelope"></i></span>
            <div><strong>Email</strong><br><a href="mailto:<?= e(SITE_EMAIL) ?>" class="text-decoration-none"><?= e(SITE_EMAIL) ?></a></div>
          </li>
          <li class="d-flex gap-3">
            <span class="icon-badge flex-shrink-0"><i class="fa-solid fa-phone"></i></span>
            <div><strong>Phone</strong><br><a href="tel:<?= e(SITE_PHONE) ?>" class="text-decoration-none"><?= e(SITE_PHONE) ?></a></div>
          </li>
          <li class="d-flex gap-3">
            <span class="icon-badge flex-shrink-0"><i class="fa-solid fa-location-dot"></i></span>
            <div><strong>Office</strong><br><?= e(SITE_ADDRESS) ?></div>
          </li>
          <li class="d-flex gap-3">
            <span class="icon-badge flex-shrink-0"><i class="fa-solid fa-clock"></i></span>
            <div><strong>Support</strong><br>Available 24/7</div>
          </li>
        </ul>
      </div>

      <div class="col-lg-7">
        <div class="card-service">
          <h2 class="h4 fw-bold mb-4">Send Us a Message</h2>
          <form action="<?= e(url('api/contact.php')) ?>" method="post" data-ajax-form novalidate>
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <!-- Honeypot field: hidden from real users via CSS, bots often fill every field. -->
            <div class="d-none" aria-hidden="true">
              <label for="website">Website</label>
              <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label fw-semibold">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required maxlength="120">
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required maxlength="180">
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label fw-semibold">Phone (optional)</label>
                <input type="tel" id="phone" name="phone" class="form-control" maxlength="40">
              </div>
              <div class="col-md-6">
                <label for="service" class="form-label fw-semibold">Service Needed</label>
                <select id="service" name="service" class="form-select">
                  <option value="">Select a service</option>
                  <?php foreach (services_catalog() as $slug => $service): ?>
                  <option value="<?= e($slug) ?>"><?= e($service['title']) ?></option>
                  <?php endforeach; ?>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="col-12">
                <label for="message" class="form-label fw-semibold">Project Details</label>
                <textarea id="message" name="message" class="form-control" rows="5" required maxlength="4000"></textarea>
              </div>
            </div>

            <button type="submit" class="btn btn-accent btn-lg rounded-pill px-4 mt-4">Send Message</button>
            <div class="form-status mt-3" data-form-status></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
