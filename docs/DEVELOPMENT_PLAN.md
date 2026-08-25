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
Status: Completed in `1.0.1`

- Per-service enquiry form
- Name, email, telephone, company, website, subject, message, budget and desired deadline
- Privacy consent
- Up to five file attachments with extension and size validation
- Honeypot anti-spam protection
- Standard OpenCart CAPTCHA integration when configured
- Database-first persistence before email delivery
- Independent `email_sent` state
- Customer/store/service association
- IP and user-agent capture
- Creation/email outcome history
- Success/error storefront UX with submitted values preserved on validation errors

Deferred from Stage 5:
- optional general Services enquiry form not tied to a specific service
- configurable file limits/extension list in administration
- configurable recipient by service/category

## Stage 6 — Enquiry administration workflow
Status: In progress in `1.0.1`

Implemented:
- dedicated **Enquiries** administration section
- enquiry counter on module dashboard
- filters by name, email, service ID, status and date range
- enquiry detail view
- submitted customer/service/store metadata
- attachment metadata
- email delivery state
- statuses
- internal notes
- status/history log
- bulk deletion

Remaining:
- administrator assignment workflow
- secure attachment download action
- reply workflow from administration
- email/reply history
- customer notification on selected status changes
- configurable status definitions if required

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

- cache invalidation review
- enquiry retention/anonymization
- rate limiting
- stronger MIME/content validation for attachments
- configurable upload policy
- database indexes/performance testing
- GDPR export/delete workflow

## Stage 10 — Stable OpenCart 3 release
Status: Planned

Full compatibility validation, migration tests, release packaging and upgrade documentation.

## Stage 11 — OpenCart 4 edition
Status: Planned

Port the stable domain contract to OpenCart 4 namespaces, events, installer structure and administration UI while preserving database and functional semantics where practical.
