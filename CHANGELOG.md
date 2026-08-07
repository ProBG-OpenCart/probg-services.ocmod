# Changelog

All notable changes to ProBG Services are documented in this file.

## [0.3.0-dev] - 2026-08-07

### Added
- Full services administration CRUD and bulk delete.
- Multilingual title, subtitle, descriptions, price text, enquiry button text and SEO metadata.
- Category, main image, social image, price, Show price, enquiry toggle, publication date, sort order and status.
- Multi-store service assignment.
- Service gallery with sortable images.
- Related services with administration autocomplete.
- Filters by title, category and status plus pagination.
- Automatic Meta Title fallback to service title.
- Standard OpenCart `seo_url` storage and manual uniqueness validation.
- Automatic service SEO URL generation as `ID-transliterated-title` with collision handling.
- Services administration menu entry.
- Bulgarian and English service language files and Twig views.

### Documentation
- README and roadmap updated for Stage 3.
- Features tab moved to Stage 3 status and Stage 4 next step.

## [0.2.0-dev] - 2026-08-07

### Added
- Full OpenCart 3 administration CRUD for service categories.
- Multi-language category content and SEO metadata.
- Parent categories, image/icon, multi-store, status, sort order, filters and pagination.
- Standard OpenCart `seo_url` integration, automatic Meta Title and transliterated collision-safe SEO URLs.
- Service Categories administration menu entry.

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
