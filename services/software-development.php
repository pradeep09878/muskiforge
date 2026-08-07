<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';
require __DIR__ . '/../includes/schema.php';

$service = [
    'slug' => 'software-development',
    'title' => 'Software Development',
    'icon' => 'fa-solid fa-code',
    'heading' => 'Custom Software Engineered Around Your Business',
    'intro' => 'Our engineering team ships custom web applications, internal tools, and SaaS platforms using PHP, Laravel, and Node.js with an emphasis on maintainability and security.',
    'features' => [
        ['icon' => 'fa-solid fa-diagram-project', 'title' => 'Custom Web Applications', 'text' => 'Purpose-built applications that model your actual business logic.'],
        ['icon' => 'fa-solid fa-layer-group', 'title' => 'SaaS Platform Builds', 'text' => 'Multi-tenant architecture, billing integration, and role-based access control.'],
        ['icon' => 'fa-solid fa-plug', 'title' => 'API Development', 'text' => 'RESTful and GraphQL APIs designed for third-party and internal integrations.'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Security-First Engineering', 'text' => 'Input validation, secure authentication, and OWASP-aligned practices as standard.'],
        ['icon' => 'fa-solid fa-vial', 'title' => 'Automated Testing', 'text' => 'Unit and integration test coverage so releases don\'t break what already works.'],
        ['icon' => 'fa-solid fa-arrows-rotate', 'title' => 'Legacy Modernization', 'text' => 'Refactoring and migrating aging codebases without disrupting the business.'],
    ],
    'benefits' => [
        'Software that fits your actual workflow instead of forcing you into one',
        'Lower long-term maintenance costs through clean, documented code',
        'Faster feature delivery once the initial platform is in place',
        'Reduced technical risk through security-first engineering practices',
    ],
    'technologies' => ['PHP 8', 'Laravel', 'Node.js', 'MySQL', 'PostgreSQL', 'Docker', 'Git'],
    'faqs' => [
        ['question' => 'What kind of software does Muskiforge build?', 'answer' => 'We build custom web applications, internal business tools, SaaS platforms, and APIs tailored to your specific workflows and business logic.'],
        ['question' => 'Can you take over an existing codebase?', 'answer' => 'Yes, we regularly take over and modernize legacy applications, including refactoring, adding test coverage, and migrating outdated frameworks.'],
        ['question' => 'Do you follow an agile process?', 'answer' => 'Yes, we work in iterative sprints with regular demos so you can review progress and adjust priorities throughout the build.'],
        ['question' => 'How do you handle software security?', 'answer' => 'We follow OWASP-aligned practices including input validation, parameterized queries, secure authentication, and regular dependency audits.'],
    ],
];

$meta = page_meta(
    'Custom Software Development Services | PHP, Laravel & Node.js | Muskiforge',
    'Muskiforge builds custom software, SaaS platforms, and APIs using PHP, Laravel, and Node.js, engineered for security, scalability, and maintainability.',
    'services/software-development.php'
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
