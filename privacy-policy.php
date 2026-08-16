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

$sections = [
    ['title' => 'Information We Collect', 'body' => 'We collect information you provide directly, such as your name, email address, phone number, and project details submitted through our contact and newsletter forms. We also collect standard technical data (IP address, browser type, pages visited) via server logs and analytics tools.'],
    ['title' => 'How We Use Your Information', 'body' => "We use collected information to respond to inquiries, deliver requested services, send newsletters you've opted into, improve our website, and comply with legal obligations. We do not sell your personal information."],
    ['title' => 'Cookies & Tracking', 'body' => 'We use cookies and similar technologies for essential site functionality and analytics. You can control cookies through your browser settings.'],
    ['title' => 'Data Sharing', 'body' => 'We do not share your personal information with third parties except trusted service providers who help us operate our business (such as hosting and email delivery providers), or where required by law.'],
    ['title' => 'Data Retention & Security', 'body' => 'We retain personal information only as long as necessary for the purposes described above and apply reasonable technical and organizational measures to protect it.'],
    ['title' => 'Your Rights', 'body' => 'You may request access to, correction of, or deletion of your personal information at any time by contacting us at <a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>.'],
    ['title' => 'Changes to This Policy', 'body' => 'We may update this policy periodically. Material changes will be reflected by an updated "last updated" date on this page.'],
];

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
<section class="py-5">
  <div class="container" style="max-width:840px">
    <span class="eyebrow">Legal</span>
    <h1 class="section-title mt-2 mb-2">Privacy Policy</h1>
    <p class="text-muted mb-5">Last updated: <?= date('F j, Y') ?></p>

    <?php foreach ($sections as $i => $section): ?>
    <div class="d-flex align-items-center gap-3 mt-4 mb-2">
      <span class="icon-badge mb-0 flex-shrink-0" style="width:36px;height:36px;font-size:.95rem;border-radius:50%"><?= $i + 1 ?></span>
      <h2 class="h5 fw-bold mb-0"><?= e($section['title']) ?></h2>
    </div>
    <p class="section-subtitle<?= $i === count($sections) - 1 ? ' mb-0' : '' ?>"><?= $section['body'] ?></p>
    <?php endforeach; ?>
  </div>
</section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
