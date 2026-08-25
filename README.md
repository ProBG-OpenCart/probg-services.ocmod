# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current development version

`1.1.0-dev` — storefront architecture aligned with ProBG Blog and adapted for services.

The last packaged beta remains `probg-services-1.0.0-beta.ocmod.zip` in `dist/` until the next package is built.

## Editions

- OpenCart 3: active development
- OpenCart 4: planned as a separate platform-specific package using the same domain contract

## Architecture

ProBG Services now follows the same core pattern proven in ProBG Blog:

- one full-page/module controller for the public section;
- one read-only storefront domain model;
- standard OpenCart `seo_url` integration;
- canonical hierarchical URLs and 301 correction;
- multi-store and language-aware catalogue queries;
- store/language scoped caching;
- dedicated sitemap endpoint plus Google Sitemap integration;
- Open Graph, Twitter Cards and JSON-LD;
- Bootstrap-oriented Twig templates;
- administration and catalogue concerns kept separate.

The concepts are adapted to the purpose of this extension: Blog categories become service categories, articles become services, BlogPosting becomes Schema.org `Service`, and visible service pricing is represented as `Offer`.

## Implemented

### Administration

- localized **Services** administration menu;
- Settings / Categories / Services navigation;
- dashboard counters;
- category CRUD with hierarchy, media, multi-store and SEO;
- service CRUD with gallery, pricing, social image, publication date and related services;
- BG/EN administration languages;
- per-route permissions.

### Public Services section

- Services landing page;
- service-category pages;
- individual service pages;
- breadcrumbs and pagination;
- main image and service gallery;
- visible/hidden price handling;
- related services;
- publication-date and status rules;
- multi-store and language filtering.

### SEO

- standard OpenCart `seo_url` records;
- automatic transliterated SEO URLs from administration;
- logical route keys `probg_service_category_id` and `probg_service_id`;
- hierarchical URL structure:

```text
/services
/services/category
/services/category/service
```

- canonical URLs;
- HTTP 301 correction when a service is requested under the wrong category;
- Meta Title, Meta Description and Meta Keywords;
- Open Graph and Twitter Cards;
- `social_image` fallback to the service main image;
- JSON-LD `CollectionPage` for listings/categories;
- JSON-LD `Service` and `Offer` for service pages.

### Sitemap and performance

Dedicated sitemap endpoint:

```text
index.php?route=extension/feed/probg_services_sitemap
```

When enabled, service URLs are also appended to the standard OpenCart Google Sitemap. Sitemap entries are limited to active records assigned to the current store/language.

Catalogue cache keys are scoped by store, language and resource:

```text
probg_services.<store_id>.<language_id>.<resource>
```

Enquiries are never cached.

## Enquiry architecture

The database foundation already separates:

- enquiries;
- enquiry files;
- enquiry history.

The next domain stage implements the public enquiry form and the dedicated administration section. The persistence rule is fixed: **the enquiry is written to the database before email notification is attempted**. Email failure must not lose a valid enquiry.

## OpenCart 4

OpenCart 4 will use a separate installable package. The database entities, service/category/enquiry domain semantics, SEO rules, sitemap resource model and validation rules remain aligned, while namespaces, routes, events, installer integration and UI code are platform-specific.

See `docs/ARCHITECTURE.md` and `docs/COMPATIBILITY.md`.

## Installation during development

1. Install the OCMOD archive through **Extensions → Installer**.
2. Refresh **Extensions → Modifications**.
3. Install **ProBG Services** from **Extensions → Extensions → Modules**.
4. Open **Services → Settings** and enable the extension.
5. Configure the services-per-page limit, sitemap and cache options.
6. Create categories and services.
7. Ensure standard OpenCart SEO URLs and `.htaccess` are enabled.

## Repository

`ProBG-OpenCart/probg-services.ocmod`

---

## Български

**ProBG Services** е многоезичен модул за каталог на услуги и управление на запитвания за OpenCart. Архитектурата на публичната част вече следва доказания модел на ProBG Blog, но е адаптирана за услуги: категории услуги, самостоятелни услуги, цени, галерии, свързани услуги, Schema.org `Service`/`Offer`, SEO URL, sitemap, кеширане и бъдещ workflow за запитвания.

Всички запитвания ще се записват в базата данни преди опита за изпращане на email и ще се управляват в отделна административна секция.

### Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
