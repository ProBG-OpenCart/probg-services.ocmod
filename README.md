# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.4.0`

Installation package:

`dist/probg-services-1.4.0.ocmod.zip`

## Editions

- OpenCart 3: active/stable development line
- OpenCart 4: planned as a separate platform-specific package using the same domain contract

## Architecture

ProBG Services follows the core architecture proven in ProBG Blog, adapted to services, merchandising and enquiry workflows. It provides multi-store/language catalogue data, standard SEO URL integration, hierarchical canonical URLs, OpenCart Layout modules, structured data, sitemap integration, caching and a database-first enquiry subsystem.

## Main capabilities

### Administration

- Services / Categories / Enquiries / Settings navigation;
- multilingual category and service CRUD;
- galleries, pricing, SEO, related services and recommended products;
- per-store Category Layout Override;
- reusable service blocks and navigation menus;
- enquiry workflow with statuses, assignee, internal notes and customer replies;
- secure file downloads, GDPR export and anonymization;
- configurable rate limiting, upload policy and retention;
- BG/EN administration languages and route permissions.

### Public Services section

- Services landing, category and service pages;
- breadcrumbs and JSON-LD `BreadcrumbList`;
- galleries, pricing, related services and recommended products;
- Open Graph, Twitter Cards and JSON-LD `CollectionPage`, `Service`, `Offer`, `Organization`;
- multi-store/language filtering;
- database-first per-service enquiry forms;
- CAPTCHA/honeypot plus configurable IP rate limiting.

### Security and GDPR

Version 1.4.0 adds:

- rate limiting by store + IP;
- upload extension, file-count and file-size policy;
- extension + MIME validation for uploaded files;
- generated storage filenames under `DIR_STORAGE/upload/`;
- permission-protected attachment downloads;
- physical file cleanup when enquiries are deleted or anonymized;
- per-enquiry JSON GDPR export;
- per-enquiry anonymization;
- configurable retention period with bulk anonymization of older enquiries;
- optimized indexes for rate limiting, assignee workflow and customer/date lookups.

Anonymization preserves the minimal operational record and workflow history while removing personal contact/content fields, IP/user-agent values and attachments.

### Performance

The `probg_services` catalogue cache is invalidated automatically after category/service mutations and global settings changes. Schema/index upgrades are idempotent and run from **Services → Settings**.

### SEO and sitemap

- standard OpenCart `seo_url` records;
- hierarchical `/services/category/service` URLs;
- canonical URLs and 301 correction;
- multilingual landing-page SEO;
- configurable provider Organization data;
- configurable sitemap `changefreq` and priorities;
- dedicated Services sitemap plus standard Google Sitemap integration.

## Upgrade notes for 1.4.0

After updating, open **Services → Settings** once. The idempotent schema check adds the new enquiry indexes where missing. Existing categories, services and enquiries are preserved.

Review the new **Security and GDPR** tab before enabling attachments in production, especially rate-limit thresholds, permitted extensions and retention days.

## OpenCart 4

OpenCart 4 will use a separate package while preserving the service/category/enquiry/layout/merchandising/security domain contract. See `docs/ARCHITECTURE.md` and `docs/COMPATIBILITY.md`.

## Installation

1. Download `probg-services-1.4.0.ocmod.zip` from GitHub Releases or `dist/`.
2. Upload through **Extensions → Installer**.
3. Refresh **Extensions → Modifications**.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Open **Services → Settings** and configure the extension.
6. Review **Security and GDPR** settings.
7. Create categories, services and optional Services Block instances.

---

# Български

## Описание

**ProBG Services** е многоезичен модул за OpenCart за услуги, категории, препоръчани продукти и клиентски запитвания. Архитектурата следва модела на ProBG Blog, адаптиран към service-domain логика.

## Ново във версия 1.4.0

- rate limiting на запитванията по магазин и IP;
- настройки за брой, размер и разширения на файловете;
- MIME проверка на качените файлове;
- защитено сваляне на файловете от администрацията;
- автоматично изтриване на физическите файлове при delete/anonymize;
- GDPR JSON export;
- анонимизиране на едно запитване;
- retention период и масово анонимизиране на старите запитвания;
- автоматично изчистване на catalogue cache след промени;
- оптимизирани database индекси.

## Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
