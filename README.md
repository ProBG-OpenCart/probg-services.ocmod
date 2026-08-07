# ProBG Services for OpenCart

A complete service catalogue and enquiry-management extension for OpenCart.

## Current version

`0.2.0-dev` — Stage 2 service categories for OpenCart 3.

## Planned editions

- `probg-services-opencart-3.x.ocmod.zip`
- `probg-services-opencart-4.x.zip`

The two editions share the same functional specification and database concepts while using platform-specific integration layers.

## Implemented

### Stage 1 — Foundation

- OpenCart 3 MVC-L administration foundation;
- install and uninstall lifecycle;
- database tables for categories, services, galleries, relations, enquiries, files, and enquiry history;
- administrator permissions;
- Bulgarian and English administration language files;
- module settings page and dedicated **Features** tab;
- persistent data policy on uninstall;
- OpenCart 4 compatibility strategy;
- technical documentation under `docs/`.

### Stage 2 — Service categories

- category create, edit, list and bulk delete operations;
- multi-language title, subtitle, short description, full HTML description and SEO metadata;
- parent category selection;
- image and icon fields;
- multi-store assignment;
- status and sort order;
- filters by title, parent category and status;
- pagination;
- SEO URLs stored in OpenCart's standard `seo_url` table;
- automatic Meta Title from category title when Meta Title is empty;
- automatic SEO URL generation when empty, including Bulgarian transliteration and collision-safe numeric suffixes;
- SEO URL uniqueness validation for manually entered keywords;
- OpenCart administration menu entry for service categories.

## Installation during development

1. Package `upload/` and `install.xml` as an OpenCart OCMOD archive.
2. Install through **Extensions → Installer**.
3. Refresh modifications.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Review user-group permissions if a non-administrator account will manage the module.

## Documentation policy

Every development stage must update `README.md`, `CHANGELOG.md`, `docs/DEVELOPMENT_PLAN.md`, the administration **Features** tab, and any affected architecture, database, compatibility, installation, or usage documentation.

## Repository

`ProBG-OpenCart/probg-services.ocmod`
