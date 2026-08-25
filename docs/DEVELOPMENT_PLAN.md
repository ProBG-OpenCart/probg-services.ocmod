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

- Recommended OpenCart products per service
- Explicit product sort order
- Product cards on public service pages
- Per-store Category Layout Override following the ProBG Blog model
- Service pages inherit their category Layout Override
- Reusable **ProBG Services Block** module instances
- Latest services mode
- Category-filtered services mode
- Featured/selected services mode
- Multilingual block heading
- Configurable block limit and image dimensions
- Idempotent schema upgrade for existing installations

## Stage 8 — Advanced SEO and navigation
Status: Next

- Breadcrumb structured data
- richer service-provider configuration
- configurable section SEO metadata
- optional service menu instances
- sitemap priority/changefreq settings

## Stage 9 — Performance, security and GDPR
Status: Planned

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
