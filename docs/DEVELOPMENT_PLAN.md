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

Stable OC3 package contract, PHP syntax matrix, upgrade/regression documentation and hardened release automation.

## Stage 11 — OpenCart 4 edition
Status: In progress (`2.0.0-dev`)

Completed so far:

- separate `opencart4/` package source tree with `install.json`;
- OpenCart 4 namespaced admin and catalog controllers;
- Bootstrap 5 administration settings view;
- native OC4 `.save` JSON settings action with permission and validation checks;
- idempotent OC4 schema installer preserving the stable OC3 table/domain contract;
- uninstall policy that preserves business and enquiry data;
- shared multilingual/multi-store storefront read model for categories and latest services;
- initial real storefront rendering from the shared Services tables;
- BG/EN administration and storefront language resources;
- dedicated OC4 PHP 8.0–8.4 syntax CI matrix;
- separate `install.json` and OC4 package-structure validation gate;
- OpenCart 4 architecture documentation and explicit package boundary from OC3.

Next implementation slice:

- full OC4 category administration CRUD;
- full OC4 service administration CRUD, gallery and merchandising links;
- enquiry submission and administration workflow;
- secure attachments / GDPR parity;
- OC4 events for navigation, metadata, sitemap and cache invalidation;
- SEO URL and canonical routing parity;
- reusable OC4 service blocks and layout integration;
- OpenCart 4 package builder, migration/regression documentation and stable release automation.
