<?php
/**
 * Renders <head> meta tags. Expects an optional $meta array in scope:
 * ['title' => ..., 'description' => ..., 'canonical' => ..., 'image' => ...]
 */

declare(strict_types=1);

$meta = $meta ?? [];
$metaTitle = $meta['title'] ?? SITE_TITLE;
$metaDescription = $meta['description'] ?? 'Muskiforge provides Website Development, Software Development, Mobile App Development, Cloud Solutions, SEO Services, Digital Marketing, and IT Consulting for businesses worldwide.';
$metaCanonical = $meta['canonical'] ?? SITE_URL . '/';
$metaImage = $meta['image'] ?? asset('images/og-cover.jpg');
?>
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDescription) ?>">
<link rel="canonical" href="<?= e($metaCanonical) ?>">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="author" content="<?= e(SITE_NAME) ?>">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<meta property="og:title" content="<?= e($metaTitle) ?>">
<meta property="og:description" content="<?= e($metaDescription) ?>">
<meta property="og:url" content="<?= e($metaCanonical) ?>">
<meta property="og:image" content="<?= e($metaImage) ?>">
<meta property="og:locale" content="en_US">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($metaTitle) ?>">
<meta name="twitter:description" content="<?= e($metaDescription) ?>">
<meta name="twitter:image" content="<?= e($metaImage) ?>">

<link rel="icon" type="image/png" href="<?= e(asset('images/favicon.png')) ?>">
