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
Status: Completed in `1.5.0`

- PHP syntax CI matrix for 7.3, 7.4, 8.0, 8.1, 8.2 and 8.3
- OCMOD XML and package source-contract validation
- installation ZIP integrity and forbidden-file validation
- bilingual release-metadata validation before publishing
- explicit OpenCart 3 compatibility levels and upgrade contract
- upgrade guide for existing 1.0.1–1.4.0 installations
- comprehensive storefront/admin/SEO/security/GDPR regression checklist
- documented OCMOD core-anchor review process

The CI matrix establishes syntax/package compatibility. Runtime acceptance on a specific production stack remains governed by `docs/REGRESSION_CHECKLIST.md` because themes, PHP builds and other OCMOD extensions can alter runtime behavior.

## Stage 11 — OpenCart 4 edition
Status: In progress

Planned implementation:

- separate OpenCart 4 installable package
- namespaced admin/catalog controllers and models
- OpenCart 4 extension installer metadata
- event-based integration where OpenCart 4 provides a stable event hook
- OpenCart 4 SEO URL integration
- Bootstrap 5 administration views
- preserved service/category/enquiry/layout/merchandising/security domain semantics
- OpenCart 4-specific compatibility and migration documentation
- package/release automation for the OpenCart 4 artifact
