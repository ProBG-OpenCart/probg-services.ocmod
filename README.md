# ProBG Services for OpenCart

A complete service catalogue and enquiry-management extension for OpenCart.

## Current version

`0.3.0-dev` — Stage 3 services administration for OpenCart 3.

## Planned editions

- `probg-services-opencart-3.x.ocmod.zip`
- `probg-services-opencart-4.x.zip`

The editions share the same functional specification and database concepts while using platform-specific integration layers.

## Implemented

### Stage 1 — Foundation
OpenCart 3 MVC-L foundation, install lifecycle, database schema, permissions, BG/EN languages, settings, Features tab, persistent-data uninstall policy, documentation, and OpenCart 4 compatibility strategy.

### Stage 2 — Service categories
Full multilingual category CRUD, hierarchy, images/icons, multi-store, filters, pagination, SEO metadata, automatic Meta Title, automatic transliterated SEO URL, and standard `seo_url` integration.

### Stage 3 — Services administration
- service create, edit, list and bulk delete;
- multilingual title, subtitle, short/full HTML descriptions;
- multilingual price text and enquiry button text;
- Meta Title, Description and Keywords;
- automatic Meta Title fallback to service title;
- category assignment;
- main and social images;
- image gallery with sort order;
- price and independent Show price option;
- independent enquiry-form enable/disable option per service;
- publication date, status and sort order;
- multi-store assignment;
- related services with autocomplete;
- filters by title, category and status;
- administration pagination;
- standard OpenCart `seo_url` integration;
- automatic SEO URL in `ID-transliterated-title` format when empty;
- manual SEO URL uniqueness validation;
- Services entry in the ProBG Services administration menu.

The enquiry form itself and persistent enquiry workflow are intentionally implemented in Stage 5; Stage 3 stores the per-service switch and button text required by that stage.

## Documentation policy

Every stage updates `README.md`, `CHANGELOG.md`, `docs/DEVELOPMENT_PLAN.md`, the administration **Features** tab, and affected technical documentation.

## Repository

`ProBG-OpenCart/probg-services.ocmod`
