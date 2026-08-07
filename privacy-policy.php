<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Privacy Policy | Muskiforge',
    'Read the Muskiforge privacy policy to understand how we collect, use, and protect your personal information.',
    'privacy-policy.php'
);

$extraSchema = schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'Privacy Policy', 'url' => url('privacy-policy.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
<section class="py-5">
  <div class="container" style="max-width:840px">
    <span class="eyebrow">Legal</span>
    <h1 class="section-title mt-2 mb-2">Privacy Policy</h1>
    <p class="text-muted mb-5">Last updated: <?= date('F j, Y') ?></p>

    <h2 class="h5 fw-bold mt-4 mb-2">1. Information We Collect</h2>
    <p class="section-subtitle">We collect information you provide directly, such as your name, email address, phone number, and project details submitted through our contact and newsletter forms. We also collect standard technical data (IP address, browser type, pages visited) via server logs and analytics tools.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">2. How We Use Your Information</h2>
    <p class="section-subtitle">We use collected information to respond to inquiries, deliver requested services, send newsletters you've opted into, improve our website, and comply with legal obligations. We do not sell your personal information.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">3. Cookies & Tracking</h2>
    <p class="section-subtitle">We use cookies and similar technologies for essential site functionality and analytics. You can control cookies through your browser settings.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">4. Data Sharing</h2>
    <p class="section-subtitle">We do not share your personal information with third parties except trusted service providers who help us operate our business (such as hosting and email delivery providers), or where required by law.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">5. Data Retention & Security</h2>
    <p class="section-subtitle">We retain personal information only as long as necessary for the purposes described above and apply reasonable technical and organizational measures to protect it.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">6. Your Rights</h2>
    <p class="section-subtitle">You may request access to, correction of, or deletion of your personal information at any time by contacting us at <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a>.</p>

    <h2 class="h5 fw-bold mt-4 mb-2">7. Changes to This Policy</h2>
    <p class="section-subtitle mb-0">We may update this policy periodically. Material changes will be reflected by an updated "last updated" date on this page.</p>
  </div>
</section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
