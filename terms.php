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

$sections = [
    ['title' => 'Acceptance of Terms', 'body' => 'By accessing this website or engaging Muskiforge for services, you agree to be bound by these Terms of Service.'],
    ['title' => 'Services', 'body' => 'Specific project scope, deliverables, timelines, and pricing are defined in individual service agreements or proposals, which take precedence over general statements made on this website.'],
    ['title' => 'Intellectual Property', 'body' => 'Unless otherwise agreed in writing, ownership of custom deliverables transfers to the client upon full payment. Muskiforge retains rights to pre-existing tools, frameworks, and general know-how used in delivery.'],
    ['title' => 'Payment Terms', 'body' => 'Payment schedules are defined per project agreement. Late payments may result in paused work until accounts are brought current.'],
    ['title' => 'Limitation of Liability', 'body' => 'Muskiforge is not liable for indirect, incidental, or consequential damages arising from use of our website or services, to the extent permitted by law.'],
    ['title' => 'Website Use', 'body' => 'You agree not to misuse this website, including attempting unauthorized access, submitting false information through our forms, or interfering with normal operation.'],
    ['title' => 'Governing Law', 'body' => 'These terms are governed by the laws of the jurisdiction in which Muskiforge is registered, without regard to conflict-of-law principles.'],
];

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
<section class="py-5">
  <div class="container" style="max-width:840px">
    <span class="eyebrow">Legal</span>
    <h1 class="section-title mt-2 mb-2">Terms of Service</h1>
    <p class="text-muted mb-5">Last updated: <?= date('F j, Y') ?></p>

    <?php foreach ($sections as $i => $section): ?>
    <div class="d-flex align-items-center gap-3 mt-4 mb-2">
      <span class="icon-badge mb-0 flex-shrink-0" style="width:36px;height:36px;font-size:.95rem;border-radius:50%"><?= $i + 1 ?></span>
      <h2 class="h5 fw-bold mb-0"><?= e($section['title']) ?></h2>
    </div>
    <p class="section-subtitle<?= $i === count($sections) - 1 ? ' mb-0' : '' ?>"><?= e($section['body']) ?></p>
    <?php endforeach; ?>
  </div>
</section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
