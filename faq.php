<?php

declare(strict_types=1);

require __DIR__ . '/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/schema.php';

$meta = page_meta(
    'Frequently Asked Questions | Muskiforge',
    'Answers to common questions about Muskiforge\'s services, process, technologies, pricing, and support.',
    'faq.php'
);

$faqGroups = [
    'Services' => [
        ['question' => 'What services does Muskiforge offer?', 'answer' => 'Muskiforge offers website development, custom software development, mobile app development, cloud solutions, SEO services, digital marketing, and IT consulting.'],
        ['question' => 'Can you redesign an existing website instead of building from scratch?', 'answer' => 'Yes. We regularly audit and redesign existing sites, preserving SEO equity while modernizing design, performance, and structure.'],
        ['question' => 'Do you provide ongoing maintenance plans?', 'answer' => 'Yes, we offer monthly maintenance plans covering updates, security monitoring, backups, and minor feature requests.'],
    ],
    'Technologies' => [
        ['question' => 'Which technologies does Muskiforge work with?', 'answer' => 'We build with HTML5, CSS3, Bootstrap, React, and Angular on the frontend; PHP, Laravel, and Node.js on the backend; Flutter, Kotlin, and Swift for mobile; and AWS, Azure, and Google Cloud for infrastructure.'],
        ['question' => 'Do you work with WordPress as well as custom code?', 'answer' => 'Yes. For content-heavy sites managed by non-technical teams we often recommend WordPress with a theme like Astra; for complex applications we build custom PHP or Node.js platforms.'],
    ],
    'Process' => [
        ['question' => 'How is your development process structured?', 'answer' => 'We follow seven stages: Discover, Plan, Design, Develop, Test, Launch, and Support, with checkpoints throughout so you always know project status.'],
        ['question' => 'How long does a typical project take?', 'answer' => 'Marketing websites typically take 3-6 weeks; custom software and mobile apps run 8-16 weeks depending on scope.'],
        ['question' => 'Will I be able to review progress during the build?', 'answer' => 'Yes, we share weekly progress updates and staging links so you can review work in real time, not just at final delivery.'],
    ],
    'Support' => [
        ['question' => 'Do you offer support after launch?', 'answer' => 'Every project includes a post-launch warranty period, plus optional 24/7 support and maintenance plans.'],
        ['question' => 'What happens if something breaks after launch?', 'answer' => 'Issues reported during the warranty period are fixed at no additional cost. After that, our support plans cover ongoing fixes and monitoring.'],
    ],
    'Pricing' => [
        ['question' => 'How much does a project with Muskiforge cost?', 'answer' => 'Pricing depends on scope, complexity, and timeline. We provide a free consultation and a detailed proposal before any work begins.'],
        ['question' => 'Do you offer fixed-price or hourly engagements?', 'answer' => 'Both. Well-defined projects are typically fixed-price; ongoing or evolving work is billed hourly or via a monthly retainer.'],
    ],
];

$allFaqs = array_merge(...array_values($faqGroups));
$extraSchema = schema_faq($allFaqs) . schema_breadcrumb([
    ['name' => 'Home', 'url' => url('index.php')],
    ['name' => 'FAQs', 'url' => url('faq.php')],
]);

require __DIR__ . '/includes/header.php';
?>
<main id="main-content">

<section class="hero py-5">
  <div class="container text-center">
    <span class="eyebrow">Support</span>
    <h1 class="section-title mt-2 mb-3">Frequently Asked Questions</h1>
    <p class="section-subtitle mx-auto fs-5" style="max-width:720px">Everything you need to know about working with Muskiforge.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <?php $groupIndex = 0; foreach ($faqGroups as $group => $items): ?>
    <div class="mb-5">
      <h2 class="h5 fw-bold text-uppercase text-muted mb-3"><?= e($group) ?></h2>
      <div class="accordion" id="faqAccordion<?= $groupIndex ?>">
        <?php foreach ($items as $i => $faq): ?>
        <div class="accordion-item">
          <h3 class="accordion-header" id="faqHeading<?= $groupIndex ?>-<?= $i ?>">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $groupIndex ?>-<?= $i ?>" aria-expanded="false" aria-controls="faqCollapse<?= $groupIndex ?>-<?= $i ?>">
              <?= e($faq['question']) ?>
            </button>
          </h3>
          <div id="faqCollapse<?= $groupIndex ?>-<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="faqHeading<?= $groupIndex ?>-<?= $i ?>" data-bs-parent="#faqAccordion<?= $groupIndex ?>">
            <div class="accordion-body section-subtitle"><?= e($faq['answer']) ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php $groupIndex++; endforeach; ?>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="cta-section text-center px-4 py-5">
      <h2 class="mb-3" style="font-weight:800">Still Have Questions?</h2>
      <a href="<?= e(url('contact.php')) ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">Contact Us</a>
    </div>
  </div>
</section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
