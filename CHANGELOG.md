# Changelog

All notable changes to ProBG Services are documented in this file.

## [0.2.0-dev] - 2026-08-07

### Added

- Full OpenCart 3 administration CRUD for service categories.
- Multi-language title, subtitle, short description, HTML description and SEO metadata.
- Parent category support.
- Category image and icon fields.
- Multi-store assignment.
- Status and sort order controls.
- Filters by category title, parent category and status.
- Administration pagination.
- Standard OpenCart `seo_url` integration.
- Automatic Meta Title fallback to category title.
- Automatic SEO URL generation when empty.
- Bulgarian-to-Latin transliteration for generated SEO URLs.
- Collision-safe numeric suffixes for automatically generated SEO URLs.
- Uniqueness validation for manually entered SEO URLs.
- Service Categories entry in the ProBG Services administration menu.
- Bulgarian and English category administration language files and Twig views.

### Changed

- Development version raised to `0.2.0-dev`.
- OCMOD menu structure changed from a single settings link to a ProBG Services menu with child entries.
- README and development documentation updated for Stage 2.

## [0.1.0-dev] - 2026-08-06

### Added

- Initial OpenCart 3 extension structure.
- Administration settings controller and Twig view.
- Bulgarian and English administration language files.
- Install lifecycle with database schema creation.
- Automatic access and modify permissions for module, categories, services, and enquiries routes.
- Database foundation for categories, services, stores, galleries, related services, enquiries, enquiry files, and enquiry history.
- Administration **Features** tab.
- OCMOD administration menu entry.
- README and technical documentation set.
- OpenCart 4 compatibility and porting strategy.

### Design decisions

- Uninstall preserves business and enquiry data by default.
- OpenCart 3 and OpenCart 4 will be distributed as separate packages.
- Enquiries are always stored in the database independently of email delivery status.
