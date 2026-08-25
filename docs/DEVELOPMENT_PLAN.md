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

## Stage 4 — Blog-aligned public catalogue architecture (`1.1.0-dev`)
Status: Completed

- Services landing page
- Service category pages
- Individual service pages
- Full-page/module dual controller pattern
- Read-only storefront domain model
- Multi-store and language-aware queries
- Publication-date/status rules
- Breadcrumbs and pagination
- Gallery and related services
- Visible/hidden pricing
- Canonical URL handling
- Hierarchical SEO URL decode/rewrite through standard OpenCart `seo_url`
- HTTP 301 correction for wrong category/service hierarchy
- Open Graph and Twitter Cards
- JSON-LD `CollectionPage`, `Service`, `Offer`, `Organization`
- Dedicated Services sitemap endpoint
- Standard Google Sitemap integration
- Store/language scoped catalogue cache
- BG/EN storefront language and Twig templates

## Stage 5 — Enquiry forms and persistent storage
Status: Next

- Per-service enquiry form
- Optional general Services enquiry form
- Name, email, telephone, company, website, subject, message, budget and desired deadline
- Privacy/terms consent
- File attachments with validation
- Anti-spam / CAPTCHA integration
- Database transaction/persistence before email delivery
- `email_sent` result stored independently
- Customer/store/service association
- Success/error storefront UX

## Stage 6 — Enquiry administration workflow
Status: Planned

Dedicated **Enquiries** administration section with filters, statuses, assignment, internal notes, history, attachment access, replies and email history.

## Stage 7 — Service merchandising and layout integration
Status: Planned

- Optional recommended products per service
- Category Layout Override following the ProBG Blog layout pattern
- Reusable service blocks/module instances for OpenCart Layouts
- Featured/latest/category-filtered service blocks

## Stage 8 — Advanced SEO and navigation
Status: Planned

- Breadcrumb structured data
- richer service-provider configuration
- configurable section SEO metadata
- optional service menu instances
- sitemap priority/changefreq settings

## Stage 9 — Performance, security and GDPR
Status: Planned

Cache invalidation, enquiry retention/anonymization, security review, rate limiting, upload hardening, indexes and performance testing.

## Stage 10 — Stable OpenCart 3 release
Status: Planned

Full compatibility validation, migration tests, install/update package, release documentation and stable package.

## Stage 11 — OpenCart 4 edition
Status: Planned

Port the stable domain contract to OpenCart 4 namespaces, events, installer structure and administration UI while preserving database and functional semantics where practical.
