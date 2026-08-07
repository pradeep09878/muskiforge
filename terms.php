<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Terms of Service | Muskiforge',
    'Read the terms of service governing your use of the Muskiforge website and engagement with our IT services.',
    'terms.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Terms of Service', 'url' => url('terms.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
<section class="py-5">
  <div class="container" style="max-width:840px">
    <span class="eyebrow">Legal</span>
    <h1 class="section-title mt-2 mb-2">Terms of Service</h1>
    <p class="text-muted mb-5">Last updated: <?= date('F j, Y') ?></p>

    <h2 class="h5 fw-bold mt-4 mb-2">1. Acceptance of Terms</h2>
    <p class="section-subtitle">By accessing this website or engaging Muskiforge for services, you agree to be bound by these Terms of Service.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">2. Services</h2>
    <p class="section-subtitle">Specific project scope, deliverables, timelines, and pricing are defined in individual service agreements or proposals, which take precedence over general statements made on this website.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">3. Intellectual Property</h2>
    <p class="section-subtitle">Unless otherwise agreed in writing, ownership of custom deliverables transfers to the client upon full payment. Muskiforge retains rights to pre-existing tools, frameworks, and general know-how used in delivery.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">4. Payment Terms</h2>
    <p class="section-subtitle">Payment schedules are defined per project agreement. Late payments may result in paused work until accounts are brought current.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">5. Limitation of Liability</h2>
    <p class="section-subtitle">Muskiforge is not liable for indirect, incidental, or consequential damages arising from use of our website or services, to the extent permitted by law.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">6. Website Use</h2>
    <p class="section-subtitle">You agree not to misuse this website, including attempting unauthorized access, submitting false information through our forms, or interfering with normal operation.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">7. Governing Law</h2>
    <p class="section-subtitle mb-0">These terms are governed by the laws of the jurisdiction in which Muskiforge is registered, without regard to conflict-of-law principles.</p>
  </div>
</section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
