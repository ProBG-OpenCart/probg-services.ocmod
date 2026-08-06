# ProBG Services for OpenCart

A complete service catalogue and enquiry-management extension for OpenCart.

## Current version

`0.1.0-dev` — Stage 1 foundation for OpenCart 3.

## Planned editions

- `probg-services-opencart-3.x.ocmod.zip`
- `probg-services-opencart-4.x.zip`

The two editions will share the same functional specification and database concepts while using platform-specific integration layers.

## Stage 1 includes

- OpenCart 3 MVC-L administration foundation;
- install and uninstall lifecycle;
- database tables for categories, services, galleries, relations, enquiries, files, and enquiry history;
- administrator permissions;
- Bulgarian and English administration language files;
- module settings page;
- dedicated **Features** tab showing implemented and upcoming work;
- persistent data policy on uninstall;
- complete project documentation under `docs/`.

## Installation during development

1. Package `upload/` and `install.xml` as an OpenCart OCMOD archive.
2. Install through **Extensions → Installer**.
3. Refresh modifications.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Review user-group permissions if a non-administrator account will manage the module.

## Documentation policy

Every development stage must update:

- `README.md`;
- `CHANGELOG.md`;
- `docs/DEVELOPMENT_PLAN.md`;
- the administration **Features** tab;
- affected architecture, database, compatibility, installation, and usage documents.

## Repository

`ProBG-OpenCart/probg-services.ocmod`
