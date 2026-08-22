# ProBG Services for OpenCart

A complete service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.0.0-beta` — current OpenCart 3 beta package. The development changelog preserves the earlier staged `0.3.x-dev` milestones.

## Editions

- OpenCart 3: `probg-services-1.0.0-beta.ocmod.zip`
- OpenCart 4: planned as a separate package

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
- category, main/social images and gallery;
- price and Show price control;
- per-service enquiry-form switch;
- publication date, status, ordering and multi-store assignment;
- related services with autocomplete;
- filters and pagination;
- automatic `ID-transliterated-title` SEO URLs and manual uniqueness validation.

### Administration structure
The administration follows the same navigation model as **ProBG Blog**:

- top-level **ProBG Services** menu with localized **Services**, **Categories**, and **Settings** entries;
- persistent **Settings / Categories / Services** navigation tabs on the module settings, lists, and edit/create forms;
- dashboard tiles for total categories and services;
- stage/version information on the settings dashboard;
- shared internal URLs and breadcrumbs instead of hardcoded menu links.

The enquiry form itself and persistent enquiry workflow are implemented in Stage 5; Stage 3 stores the per-service switch and button text required by that stage.

## Documentation policy

Every stage updates `README.md`, `CHANGELOG.md`, `docs/DEVELOPMENT_PLAN.md`, the administration **Features** tab, and affected technical documentation.

## Repository

`ProBG-OpenCart/probg-services.ocmod`

## Installation package

The ready OpenCart 3 package is `probg-services-1.0.0-beta.ocmod.zip`. Upload it through **Extensions → Installer**, refresh **Extensions → Modifications**, then install the module from **Extensions → Extensions → Modules**.

## Support development

If this module is useful to you, you can support its development through Revolut:

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-0075EB?style=for-the-badge&logo=revolut&logoColor=white)](https://revolut.me/vtotev)

## Подкрепете разработката

Ако модулът ви е полезен, можете да подкрепите неговата разработка чрез Revolut:

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-0075EB?style=for-the-badge&logo=revolut&logoColor=white)](https://revolut.me/vtotev)
