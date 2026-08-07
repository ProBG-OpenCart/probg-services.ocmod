# Development plan

## Stage 1 — Architecture and foundation (`0.1.0-dev`)
Status: Completed

Foundation, lifecycle, permissions, languages, settings, database schema, documentation and OpenCart 4 strategy.

## Stage 2 — Service categories (`0.2.0-dev`)
Status: Completed

Multilingual category CRUD, hierarchy, media, stores, SEO, filters, pagination and automatic metadata/SEO URL generation.

## Stage 3 — Services administration (`0.3.0-dev`)
Status: Completed

- Full service CRUD and bulk deletion
- Multilingual title, subtitle, short/full HTML descriptions
- Multilingual price text and enquiry button text
- Meta Title, Meta Description and Meta Keywords
- Automatic Meta Title fallback
- Category assignment
- Main and social images
- Gallery with image sort order
- Price and Show price control
- Per-service enquiry enable/disable switch
- Multi-store assignment
- Publication date, status and sort order
- Related services with autocomplete
- Filters and pagination
- Standard OpenCart `seo_url` integration
- Automatic `ID-transliterated-title` SEO URLs
- Manual SEO URL uniqueness validation
- BG/EN administration interface

Recommended-product links remain planned as an additive service merchandising feature and will be introduced with the public/service integration work without changing the Stage 3 database contract.

## Stage 4 — Public pages (`0.4.0`)
Status: Next

Public Services landing page, category pages and individual service pages; breadcrumbs, pagination, store/language filtering, images/gallery, prices, related services, publication/status rules and initial SEO URL routing.

## Stage 5 — Enquiry forms and persistent storage (`0.5.0`)
Status: Planned

Per-service and general enquiry forms. Every enquiry is stored in the database before email delivery; failed email delivery must never lose the enquiry.

## Stage 6 — Enquiry workflow (`0.6.0`)
Status: Planned

Dedicated administration Enquiries section, statuses, notes, assignment, history, replies and file management.

## Stage 7 — SEO and structured data (`0.7.0`)
Status: Planned

## Stage 8 — OpenCart integrations (`0.8.0`)
Status: Planned

## Stage 9 — Performance, security and GDPR (`0.9.0`)
Status: Planned

## Stage 10 — Stable OpenCart 3 release (`1.0.0`)
Status: Planned

## Stage 11 — OpenCart 4 edition (`1.1.0`)
Status: Planned
