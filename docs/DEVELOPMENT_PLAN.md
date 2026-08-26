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

Rate limiting, hardened uploads, secure downloads, GDPR export/anonymization, retention, cache invalidation and performance indexes.

## Stage 10 — Stable OpenCart 3 release
Status: In progress for `1.5.0`

Completed in the stabilization branch:

- PHP syntax CI matrix for 7.3, 7.4, 8.0, 8.1, 8.2 and 8.3
- OCMOD/package source contract validation
- installation ZIP integrity and forbidden-file validation
- bilingual release-metadata validation before packaging
- explicit OpenCart 3 compatibility levels and upgrade contract
- upgrade guide for 1.0.1 → current through 1.4.0 → current
- comprehensive storefront/admin/SEO/security regression checklist
- OCMOD anchor review started against official OpenCart 3 core files

Remaining release gate:

- complete standard-core anchor review across representative 3.0.2.x and 3.0.3.x versions
- run documented runtime install/upgrade regression cases on test OpenCart instances
- fix any runtime regressions discovered
- finalize 1.5.0 bilingual CHANGELOG, README and release notes
- PR validation, squash merge and automated `v1.5.0` release

## Stage 11 — OpenCart 4 edition
Status: Planned

Port the stable domain contract to OpenCart 4 namespaces, events, installer structure and administration UI while preserving database and functional semantics where practical.
