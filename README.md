# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.0.1`

Installation package:

`dist/probg-services-1.0.1.ocmod.zip`

## Editions

- OpenCart 3: active/stable development line
- OpenCart 4: planned as a separate platform-specific package using the same domain contract

## Architecture

ProBG Services follows the same core architecture proven in ProBG Blog, adapted to the service catalogue domain:

- one full-page/module controller for the public section;
- one read-only storefront domain model;
- standard OpenCart `seo_url` integration;
- canonical hierarchical URLs and 301 correction;
- multi-store and language-aware catalogue queries;
- store/language scoped caching;
- dedicated sitemap endpoint plus Google Sitemap integration;
- Open Graph, Twitter Cards and JSON-LD;
- Bootstrap-oriented Twig templates;
- administration and catalogue concerns kept separate;
- enquiry writes handled by a dedicated persistence model.

Blog categories map to service categories, articles map to services, and `BlogPosting` is replaced by Schema.org `Service` with `Offer` when a price is visible.

## Implemented

### Administration

- localized **Services** administration menu;
- Settings / Categories / Services / Enquiries navigation;
- dashboard counters for categories, services and enquiries;
- category CRUD with hierarchy, media, multi-store and SEO;
- service CRUD with gallery, pricing, social image, publication date and related services;
- dedicated enquiry list with filters;
- enquiry detail page;
- enquiry statuses and internal notes;
- complete enquiry history;
- attachment metadata;
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

### Enquiries

Each service can independently enable or disable its enquiry form.

The public form supports:

- name;
- email;
- telephone;
- company;
- website;
- subject;
- budget;
- desired deadline;
- message;
- privacy consent;
- up to five attachments;
- standard OpenCart CAPTCHA when configured;
- honeypot anti-spam protection.

The persistence rule is strict: **a valid enquiry is written to the database before email notification is attempted**. SMTP/email failure therefore never discards the enquiry. Email delivery state is stored separately in `email_sent`, and every creation/delivery event is recorded in enquiry history.

Files are stored under `DIR_STORAGE/upload/` using generated random filenames. The original client filename is stored only as metadata.

### Enquiry administration workflow

The dedicated **Services → Enquiries** section provides:

- filters by customer name;
- email filter;
- service ID filter;
- status filter;
- date range filter;
- enquiry detail view;
- customer/contact data;
- service/store/customer association;
- IP and user-agent information;
- attachment metadata;
- email delivery state;
- internal notes;
- status history.

Statuses:

- New;
- Viewed;
- Needs information;
- Quote sent;
- In progress;
- Accepted;
- Rejected;
- Completed;
- Spam.

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

## OpenCart 4

OpenCart 4 will use a separate installable package. Database entities, service/category/enquiry domain semantics, SEO rules, sitemap resource model and validation rules remain aligned, while namespaces, routes, events, installer integration and UI code remain platform-specific.

See `docs/ARCHITECTURE.md` and `docs/COMPATIBILITY.md`.

## Installation

1. Download `probg-services-1.0.1.ocmod.zip` from GitHub Releases or `dist/`.
2. Upload it through **Extensions → Installer**.
3. Refresh **Extensions → Modifications**.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Open **Services → Settings** and enable the extension.
6. Configure services-per-page, sitemap and cache options.
7. Create categories and services.
8. Ensure standard OpenCart SEO URLs and `.htaccess` are enabled.

## Repository

`ProBG-OpenCart/probg-services.ocmod`

---

# Български

## Описание

**ProBG Services** е многоезичен модул за OpenCart за управление и представяне на услуги, категории услуги и клиентски запитвания. Публичната архитектура следва доказания модел на ProBG Blog, но е адаптирана към услуги — цени, галерии, свързани услуги, Schema.org `Service`/`Offer`, SEO URL, sitemap и отделен workflow за запитвания.

## Запитвания

Към всяка услуга може да бъде включена собствена форма за запитване. Валидното запитване се записва **първо в базата данни**, а след това се прави опит за изпращане на email. При SMTP грешка записът остава наличен в администрацията.

В **Услуги → Запитвания** има отделна секция със списък, филтри, статуси, детайлни данни, файлове, вътрешни бележки и история на обработката.

Версия `1.0.1` добавя публичните страници по архитектурата на ProBG Blog и пълната основа на системата за запитвания.

## Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
