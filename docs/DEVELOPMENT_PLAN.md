# Development plan

## Stage 1 — Architecture and foundation
Status: Completed

OpenCart 3 lifecycle, permissions, languages, settings, database schema, documentation and OpenCart 4 boundary.

## Stage 2 — Service categories
Status: Completed

Multilingual category CRUD, hierarchy, media, stores, SEO, filters, pagination and automatic metadata/SEO URL generation.

## Stage 3 — Services administration
Status: Completed

Service CRUD, multilingual content, gallery, pricing, social image, related services, publication controls, stores, filters, pagination and SEO URL management.

## Stage 4 — Blog-aligned public catalogue architecture
Status: Completed in `1.0.1`

Services landing/category/service pages, full-page/module architecture, read-only storefront model, multi-store/language queries, SEO routing, canonical/301 handling, social metadata, structured data, sitemap and cache.

## Stage 5 — Enquiry forms and persistent storage
Status: Completed in `1.0.1`

Per-service form, privacy validation, attachments, honeypot/CAPTCHA, database-first persistence, independent email state and enquiry history.

## Stage 6 — Enquiry administration workflow
Status: Completed in `1.1.0`

Dedicated Enquiries administration, filters, assignee, statuses, internal notes, direct customer replies and durable history.

## Stage 7 — Service merchandising and layout integration
Status: Completed in `1.2.0`

Recommended products, Category Layout Override and reusable Latest/Category/Featured service blocks.

## Stage 8 — Advanced SEO and navigation
Status: Completed in `1.3.0`

- Multilingual SEO metadata and description for the Services landing page
- Configurable service-provider Organization name, URL and logo
- JSON-LD `BreadcrumbList` generated from visible breadcrumbs
- Configurable sitemap `changefreq`
- Separate sitemap priorities for section, category and service URLs
- **Services menu** mode in ProBG Services Block
- Independent visibility controls for Services home, categories and services
- BG/EN administration labels and documentation

## Stage 9 — Performance, security and GDPR
Status: Next

- cache invalidation review
- enquiry retention/anonymization
- rate limiting
- stronger MIME/content validation for attachments
- configurable upload policy
- secure attachment download
- database indexes/performance testing
- GDPR export/delete workflow

## Stage 10 — Stable OpenCart 3 release
Status: Planned

Full compatibility validation, migration tests, release packaging and upgrade documentation.

## Stage 11 — OpenCart 4 edition
Status: Planned

Port the stable domain contract to OpenCart 4 namespaces, events, installer structure and administration UI while preserving database and functional semantics where practical.
