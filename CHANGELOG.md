# Changelog

All notable changes to ProBG Services are documented in this file.

## [1.1.0-dev] - 2026-08-25

### Added
- Public Services landing page following the ProBG Blog full-page controller pattern.
- Public service-category pages with pagination and multilingual content.
- Individual service pages with main image, gallery, price display, related services and enquiry CTA placeholder.
- Dedicated read-only catalog model for categories, services, galleries, related services and sitemap data.
- Store/language scoped catalog cache keys.
- Publication rules for disabled and future-dated services.
- Hierarchical SEO route keys `probg_service_category_id` and `probg_service_id`.
- Canonical URLs and HTTP 301 correction when a service is requested under the wrong category.
- Open Graph and Twitter Card output for Services pages.
- JSON-LD `CollectionPage` for listing/category pages.
- JSON-LD `Service`, `Offer` and `Organization` provider data for service pages.
- Dedicated `extension/feed/probg_services_sitemap` endpoint.
- Integration with the standard OpenCart Google Sitemap.
- Store/language-aware sitemap filtering.
- Bulgarian and English storefront language files.
- Bootstrap-oriented Twig templates for listing, category, service, module and not-found output.
- Services-per-page, sitemap and cache settings in administration.

### Changed
- Core storefront architecture aligned with the proven ProBG Blog architecture while preserving service-domain semantics.
- OCMOD now extends the standard OpenCart SEO URL decoder/rewriter for service categories and services.
- OCMOD now injects Services social metadata into the common theme header using the same integration strategy as ProBG Blog.
- Administration stage indicator moved to Stage 4.
- Development version raised to `1.1.0-dev`.

### Architecture decisions
- Service pages use Schema.org `Service`/`Offer` rather than blog-specific schemas.
- The public service catalogue remains isolated from the enquiry workflow.
- Enquiry persistence remains database-first: email delivery can fail without losing a valid enquiry.
- OpenCart 4 remains a separate integration layer sharing the same domain contract.

## [0.3.2-dev] - 2026-08-14

### Added
- Administration root menu follows the ProBG Blog pattern: localized root label, individually permissioned child entries, and insertion before Design.
- Bulgarian root menu label changed to **Услуги** and English root menu label to **Services**.

### Changed
- Services menu implementation normalized to the same compact OCMOD structure used by ProBG Blog.

## [0.3.1-dev] - 2026-08-14

### Added
- Unified administration navigation modeled after ProBG Blog: **Settings / Categories / Services**.
- Shared top-level section tabs on settings, category list/form and service list/form pages.
- Dashboard tiles showing total service categories and services.
- Localized administration menu labels and shared internal routes.

## [0.3.0-dev] - 2026-08-07

### Added
- Full services administration CRUD and bulk delete.
- Multilingual title, subtitle, descriptions, price text, enquiry button text and SEO metadata.
- Category, main image, social image, price, Show price, enquiry toggle, publication date, sort order and status.
- Multi-store service assignment.
- Service gallery and related services.
- Filters, pagination and automatic service SEO URLs.

## [0.2.0-dev] - 2026-08-07

### Added
- Full OpenCart 3 administration CRUD for service categories.
- Multi-language category content and SEO metadata.
- Parent categories, image/icon, multi-store, status, sort order, filters and pagination.
- Standard OpenCart `seo_url` integration and automatic transliterated SEO URLs.

## [0.1.0-dev] - 2026-08-06

### Added
- Initial OpenCart 3 extension structure and install lifecycle.
- Database foundation for categories, services, galleries, relations, enquiries, files and history.
- Administrator permissions, BG/EN languages, settings and Features tab.
- README and technical documentation plus OpenCart 4 porting strategy.

### Design decisions
- Uninstall preserves business and enquiry data by default.
- OpenCart 3 and OpenCart 4 are distributed as separate packages.
- Enquiries are stored independently of email delivery status.
