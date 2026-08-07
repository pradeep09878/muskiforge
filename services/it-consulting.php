<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'it-consulting',
    'title' => 'IT Consulting',
    'icon' => 'fa-solid fa-lightbulb',
    'heading' => 'Strategic Technology Guidance for Growing Businesses',
    'intro' => 'Our consultants help leadership teams make sound technology decisions — architecture reviews, vendor selection, security posture, and digital transformation roadmaps.',
    'features' => [
        ['icon' => 'fa-solid fa-sitemap', 'title' => 'Architecture Reviews', 'text' => 'Independent assessment of your current systems and where they\'ll break under growth.'],
        ['icon' => 'fa-solid fa-scale-balanced', 'title' => 'Vendor & Tooling Selection', 'text' => 'Unbiased recommendations on platforms, frameworks, and vendors that fit your needs.'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Security Posture Assessment', 'text' => 'Identifying gaps in your infrastructure, access controls, and data handling.'],
        ['icon' => 'fa-solid fa-map', 'title' => 'Digital Transformation Roadmaps', 'text' => 'A prioritized, realistic plan for modernizing systems and processes.'],
        ['icon' => 'fa-solid fa-users-gear', 'title' => 'Team & Process Advisory', 'text' => 'Guidance on structuring engineering teams and delivery processes as you scale.'],
        ['icon' => 'fa-solid fa-file-contract', 'title' => 'Technical Due Diligence', 'text' => 'Independent technical assessments to support investment or acquisition decisions.'],
    ],
    'benefits' => [
        'Fewer costly technology mistakes made without independent input',
        'A clear, prioritized roadmap instead of ad hoc technology decisions',
        'Reduced security and compliance risk through proactive assessment',
        'Confidence in vendor and platform decisions backed by real evaluation',
    ],
    'technologies' => ['AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Security Frameworks'],
    'faqs' => [
        ['question' => 'When should we bring in an IT consultant?', 'answer' => 'Common triggers are planning a major system migration, evaluating new vendors, preparing for a funding round or acquisition, or when your current systems are struggling to keep up with growth.'],
        ['question' => 'Is IT consulting only for large enterprises?', 'answer' => 'No, we work with startups and SMEs as well as enterprises — the scope and depth of the engagement simply scales to your size and needs.'],
        ['question' => 'Do you implement the recommendations yourselves?', 'answer' => 'We can, through our software, cloud, and web development teams, or hand the roadmap to your internal team to execute.'],
        ['question' => 'How is IT consulting engagement structured?', 'answer' => 'Engagements typically start with a discovery assessment, followed by a findings report and roadmap, delivered on a project or retainer basis depending on scope.'],
    ],
];

$meta = page_meta(
    'IT Consulting Services | Technology Strategy & Roadmaps | Muskiforge',
    'Muskiforge provides IT consulting including architecture reviews, vendor selection, security assessments, and digital transformation roadmaps for growing businesses.',
    'services/it-consulting.php'
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
