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

Multilingual section SEO, configurable provider, `BreadcrumbList`, sitemap metadata and Services menu instances.

## Stage 9 — Performance, security and GDPR
Status: Completed in `1.4.0`

- automatic catalogue cache invalidation after category/service/settings mutations
- configurable store/IP enquiry rate limiting
- configurable file count, file size and extension policy
- extension + MIME validation before upload persistence
- random filenames under `DIR_STORAGE/upload/`
- permission-protected secure attachment downloads
- physical file cleanup on delete/anonymize
- per-enquiry GDPR JSON export
- per-enquiry anonymization
- configurable retention period and bulk anonymization of older enquiries
- composite indexes for assignee workflow, rate limiting and customer/date lookups
- BG/EN administration and storefront security messages

## Stage 10 — Stable OpenCart 3 release
Status: Next

- compatibility matrix validation across supported OpenCart 3 releases
- PHP compatibility pass
- install/upgrade/migration tests from 1.0.1, 1.1.0, 1.2.0 and 1.3.0
- OCMOD conflict review against standard OpenCart files
- database schema consistency checks
- storefront/admin regression checklist
- final stable documentation and upgrade guide

## Stage 11 — OpenCart 4 edition
Status: Planned

Port the stable domain contract to OpenCart 4 namespaces, events, installer structure and administration UI while preserving database and functional semantics where practical.
