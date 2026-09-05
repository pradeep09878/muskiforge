---
name: Kinetic Obsidian
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#45474c'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#75777d'
  outline-variant: '#c5c6cd'
  surface-tint: '#545f73'
  primary: '#091426'
  on-primary: '#ffffff'
  primary-container: '#1e293b'
  on-primary-container: '#8590a6'
  inverse-primary: '#bcc7de'
  secondary: '#0051d5'
  on-secondary: '#ffffff'
  secondary-container: '#316bf3'
  on-secondary-container: '#fefcff'
  tertiary: '#0b1426'
  on-tertiary: '#ffffff'
  tertiary-container: '#20283c'
  on-tertiary-container: '#888fa7'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d8e3fb'
  primary-fixed-dim: '#bcc7de'
  on-primary-fixed: '#111c2d'
  on-primary-fixed-variant: '#3c475a'
  secondary-fixed: '#dbe1ff'
  secondary-fixed-dim: '#b4c5ff'
  on-secondary-fixed: '#00174b'
  on-secondary-fixed-variant: '#003ea8'
  tertiary-fixed: '#dae2fd'
  tertiary-fixed-dim: '#bec6e0'
  on-tertiary-fixed: '#131b2e'
  on-tertiary-fixed-variant: '#3f465c'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  display-xl:
    fontFamily: Geist
    fontSize: 64px
    fontWeight: '600'
    lineHeight: 72px
    letterSpacing: -0.035em
  display-xl-mobile:
    fontFamily: Geist
    fontSize: 40px
    fontWeight: '600'
    lineHeight: 48px
    letterSpacing: -0.025em
  headline-lg:
    fontFamily: Geist
    fontSize: 44px
    fontWeight: '600'
    lineHeight: 52px
    letterSpacing: -0.03em
  headline-lg-mobile:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '500'
    lineHeight: 40px
    letterSpacing: -0.025em
  headline-sm:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '500'
    lineHeight: 32px
    letterSpacing: -0.02em
  title-md:
    fontFamily: Geist
    fontSize: 18px
    fontWeight: '500'
    lineHeight: 26px
    letterSpacing: -0.015em
  body-lg:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 26px
    letterSpacing: -0.01em
  body-md:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 22px
    letterSpacing: -0.005em
  body-sm:
    fontFamily: Geist
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 18px
    letterSpacing: 0em
  label-code:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 16px
    letterSpacing: -0.01em
  label-caps:
    fontFamily: Geist
    fontSize: 11px
    fontWeight: '600'
    lineHeight: 14px
    letterSpacing: 0.06em
rounded:
  sm: 0.5rem
  DEFAULT: 1rem
  md: 1.5rem
  lg: 2rem
  xl: 3rem
  full: 9999px
spacing:
  space-2xs: 0.25rem
  space-xs: 0.5rem
  space-sm: 0.75rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
  space-2xl: 3rem
  space-3xl: 4.5rem
  space-4xl: 6rem
  space-section: 8rem
  gutter-mobile: 1rem
  gutter-desktop: 1.5rem
  margin-mobile: 1.25rem
  margin-tablet: 2.5rem
  margin-desktop: 3rem
  max-width-content: 1280px
  max-width-prose: 680px
---

## Brand & Style

This design system embodies high-precision minimalism crafted for premium IT services, engineering advisories, and elite digital infrastructure consultancies. Synthesizing the quiet restraint of Apple hardware design, the systematic typographic discipline of Stripe, and the tactile, performance-driven precision of Linear, the system communicates engineering rigor, structural clarity, and decisive technical mastery.

The visual language rejects decorative clutter, artificial gradients, and superfluous novelty. In their place, it deploys strict structural alignment, meticulous spatial ratios, crisp single-pixel delimiters, and a deliberate rhythm of breath and density. Micro-interactions are immediate, damped, and physical—giving interactive surfaces a weightless yet responsive quality.

Targeted at enterprise decision-makers, CTOs, and high-growth engineering leaders, the aesthetic evokes certainty, velocity, and uncompromising craftsmanship. Trust is established not through overt claims, but through immaculate detail, rigorous type composition, and architectural calm.

## Colors

The palette operates on an ultra-disciplined, high-luminance canvas grounded by deep slate neutrals and energized by a single surgical accent.

- **Background Canvas (`#FBFBFC`)**: The primary structural plane, providing a soft pearl finish that eliminates glare while maintaining pristine air.
- **Surface Elevation (`#FFFFFF`)**: Pure white containers, layered cards, and input fields that elevate naturally above the pearl foundation.
- **Deep Slate / Obsidian (`#0F172A`)**: The primary ink token, deployed across high-impact headings and primary CTA surfaces. It provides contrast sharper and more refined than pure black.
- **Secondary Slate (`#334155` & `#64748B`)**: Secondary text, supporting labels, structural captions, and muted icons. Ensures legibility while reinforcing hierarchy.
- **Electric Cobalt (`#2563EB`)**: The focused interactive accent. Reserved strictly for active indicators, link focus, key performance metrics, selection outlines, and delicate interactive micro-states. Never used in heavy, decorative floods.
- **Borders & Dividers (`#E2E8F0`)**: Hairline 1px structural strokes that define containment without visual noise. A secondary state (`#F1F5F9`) exists for interior subdivision.

## Typography

Typography adheres to Swiss modernist principles: objective, direct, and structurally ordered. 

- **Geist** acts as both primary display and body engine, leveraging its neutral neo-grotesque skeleton, mechanical precision, and exceptionally clean metrics at dense scales.
- Headings require negative tracking that tightens proportionally as scale increases (from `-0.015em` at 18px to `-0.035em` at 64px), reproducing the razor-sharp lockups characteristic of premier engineering brands.
- **JetBrains Mono** is introduced selectively for metadata, architectural tags, key telemetry readouts, status identifiers, and tabular numbers, anchoring the technical credibility of the interface.
- Uppercase text (`label-caps`) is strictly reserved for micro-eyebrows, status badges, and column headers, paired with extended positive tracking (`+0.06em`) to ensure instant parsing without visual weight.

## Layout & Spacing

The layout system operates on an 8-point spatial base with a disciplined 12-column dynamic grid. Layouts prioritize horizontal alignment continuity, generous outer margins, and structured macro-rhythms.

- **Desktop (1024px+)**: Max container width of 1280px, centered with fluid side margins (`margin-desktop: 3rem`) and 24px (`gutter-desktop: 1.5rem`) gutters. Content sections span standard increments of 3, 4, 6, 8, or 12 columns.
- **Tablet (768px – 1023px)**: 8-column layout, 24px gutters, 40px outer margins. Complex multi-column data views reflow into 4-column paired groupings.
- **Mobile (320px – 767px)**: 4-column layout, 16px gutters, 20px margins. Layouts compress linearly into single-column vertical stacks.
- **Rhythm**: Macro section padding alternates between `space-3xl` (72px) and `space-section` (128px), giving major service disciplines and capabilities room to breathe. Interior card padding is locked to `space-lg` (24px) or `space-xl` (32px).

## Elevation & Depth

Visual hierarchy rejects exaggerated, murky drop shadows in favor of ambient low-contrast outlines and atmospheric surface layering.

- **Surface Strategy**: The primary canvas rests at `#FBFBFC`. Interactive panels, modules, and service blocks sit on `#FFFFFF`. Depth is established primarily by this color differentiation and crisp 1px borders (`#E2E8F0`).
- **Ambient Elevation**: For elevated elements like popovers, dropdowns, and active cards, depth is achieved via microscopic double-layer shadows:
  - Base layer: `0 1px 2px 0 rgba(15, 23, 42, 0.04)`
  - Atmospheric layer: `0 8px 24px -4px rgba(15, 23, 42, 0.05)`
  - Edge highlight: Inset 1px line `inset 0 1px 0 0 rgba(255, 255, 255, 0.8)` for a refined glass-edge specular sheen.
- **Backdrop Diffusion**: Sticky headers, modals, and navigation drawers use frosted translucency: `background: rgba(251, 251, 252, 0.82)` paired with `backdrop-filter: blur(16px) saturate(180%)`, maintaining context as users scroll through dense case studies and service matrices.

## Shapes

The design system employs a hybrid geometric strategy: pill-shaped elements for directional, interactive CTAs, paired with soft, controlled rectangular curves for structural containers.

- **Pill Geometry (Full Radius / `9999px`)**: Exclusively applied to primary action buttons, status pills, filter chips, and pill tabs. This creates distinct, ergonomic focal points inspired by Apple and Linear action bars.
- **Module Geometry (`rounded-xl` / 12px–16px)**: Structural surfaces, dashboard panels, and service showcase cards utilize subtle 12px (`0.75rem`) to 16px (`1rem`) radii, preserving an architectural feel without looking toy-like.
- **Nested Ratio Rule**: Inner elements inside cards always scale their radius proportionally (outer radius minus inner padding) to avoid visual pinching.

## Components

### Buttons
- **Primary**: Pill-shaped (`rounded-full`), background `#0F172A`, text `#FFFFFF`. Subtle top-edge inset highlight (`inset 0 1px 0 0 rgba(255, 255, 255, 0.16)`). Hover: background `#1E293B`, transforms scale `1.01`, subtle ambient shadow. Active: transforms scale `0.98`.
- **Secondary**: Pill-shaped, background `#FFFFFF`, border `1px solid #E2E8F0`, text `#0F172A`. Hover: background `#F8FAFC`, border `#CBD5E1`.
- **Accent / Special Action**: Pill-shaped, background `#2563EB`, text `#FFFFFF`. Hover: background `#1D4ED8`. Used sparingly for high-intent conversions (e.g., "Deploy Advisory").
- **Ghost / Tertiary**: Text `#334155`, transparent background. Hover: text `#0F172A`, background `#F1F5F9`.

### Input Fields & Controls
- **Text Inputs**: Height 44px, background `#FFFFFF`, border `1px solid #E2E8F0`, corner radius 8px, font size 14px, text `#0F172A`, placeholder `#94A3B8`.
- **Focus State**: Border `#2563EB`, box-shadow `0 0 0 3px rgba(37, 99, 235, 0.12)`. No abrupt transitions; ease with `150ms cubic-bezier(0.16, 1, 0.3, 1)`.
- **Checkboxes & Radios**: 16px squares/circles, border `1.5px solid #CBD5E1`. Checked: background `#2563EB`, border `#2563EB`, crisp white micro checkmark/bullet.

### Chips & Badges
- **Status Indicator**: Pill-shaped, height 24px, padding 0 10px. Background `#F1F5F9`, border `1px solid #E2E8F0`. Text formatted in `JetBrains Mono` at 11px uppercase (`label-caps`).
- **Active State**: Contains a 6px circular pulsing or static dot (`#2563EB` or `#10B981` for uptime/live status).

### Cards & Surfaces
- **Interactive Service Card**: Background `#FFFFFF`, border `1px solid #E2E8F0`, padding 32px, corner radius 16px. Hover: subtle border shift to `#CBD5E1`, ambient shadow `0 12px 32px -8px rgba(15, 23, 42, 0.06)`, upward displacement `-2px`.
- **Stat / Metric Display Card**: Pure white background, hairline border `#E2E8F0`. Features high-contrast numerical metrics in `Geist` (font-weight 600, negative tracking `-0.03em`) stacked above a 12px mono descriptive tag.

### Lists & Tables
- **Divided Data List**: Transparent rows with hairline bottom borders (`1px solid #F1F5F9`). Row hover: background `#F8FAFC` spanning edge-to-edge.
- **Service Spec Matrix**: Two-column layout with left-aligned monospaced parameter tags (`#64748B`) and right-aligned slate values (`#0F172A`).