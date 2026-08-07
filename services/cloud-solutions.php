<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'cloud-solutions',
    'title' => 'Cloud Solutions',
    'icon' => 'fa-solid fa-cloud',
    'heading' => 'Cloud Infrastructure Built to Scale With You',
    'intro' => 'We design resilient, cost-efficient cloud infrastructure and manage migrations, CI/CD pipelines, and container orchestration for growing businesses.',
    'features' => [
        ['icon' => 'fa-solid fa-cloud-arrow-up', 'title' => 'Cloud Migration', 'text' => 'Moving workloads to AWS, Azure, or Google Cloud with minimal downtime.'],
        ['icon' => 'fa-solid fa-sitemap', 'title' => 'Infrastructure Architecture', 'text' => 'Scalable, resilient infrastructure designed around your actual traffic patterns.'],
        ['icon' => 'fa-brands fa-docker', 'title' => 'Containerization', 'text' => 'Docker and Kubernetes setups for consistent deployments across environments.'],
        ['icon' => 'fa-solid fa-arrows-spin', 'title' => 'CI/CD Pipelines', 'text' => 'Automated build, test, and deployment pipelines using Jenkins and Git workflows.'],
        ['icon' => 'fa-solid fa-chart-line', 'title' => 'Cost Optimization', 'text' => 'Right-sizing infrastructure to cut cloud spend without sacrificing performance.'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Monitoring & Security', 'text' => 'Uptime monitoring, alerting, and security hardening across your cloud footprint.'],
    ],
    'benefits' => [
        'Improved uptime and resilience through properly architected infrastructure',
        'Lower cloud spend through right-sizing and cost monitoring',
        'Faster releases through automated CI/CD pipelines',
        'Reduced operational burden on your internal team',
    ],
    'technologies' => ['AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Jenkins', 'Git'],
    'faqs' => [
        ['question' => 'Which cloud providers do you work with?', 'answer' => 'We work across AWS, Microsoft Azure, and Google Cloud, and can recommend the best fit based on your existing stack and budget.'],
        ['question' => 'Can you migrate our infrastructure with zero downtime?', 'answer' => 'For most applications, yes. We plan migrations in phases with rollback options to minimize or eliminate downtime.'],
        ['question' => 'Do you offer ongoing cloud management after migration?', 'answer' => 'Yes, we offer managed cloud support covering monitoring, security patching, cost optimization, and incident response.'],
        ['question' => 'Can you help reduce our current cloud costs?', 'answer' => 'Yes, our cloud audits typically identify right-sizing opportunities, unused resources, and reserved-instance savings that meaningfully reduce monthly spend.'],
    ],
];

$meta = page_meta(
    'Cloud Solutions & DevOps Services | AWS, Azure & GCP | Muskiforge',
    'Muskiforge designs and manages cloud infrastructure on AWS, Azure, and Google Cloud, including migrations, CI/CD pipelines, and container orchestration.',
    'services/cloud-solutions.php'
);

$extraSchema = schema_service($service['title'], $service['intro'], $service['slug'])
    . schema_faq($service['faqs'])
    . schema_breadcrumb([
        ['name' => 'Home', 'url' => url('index.php')],
        ['name' => 'Services', 'url' => url('services.php')],
        ['name' => $service['title'], 'url' => url('services/' . $service['slug'] . '.php')],
    ]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/service-template.php';
require __DIR__ . '/../includes/footer.php';
