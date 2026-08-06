# Changelog

All notable changes to ProBG Services are documented in this file.

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
