# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.5.0`

Installation package:

`dist/probg-services-1.5.0.ocmod.zip`

## Editions

- OpenCart 3: stable line
- OpenCart 4: separate platform-specific edition under Stage 11 development

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

- rate limiting by store + IP;
- upload extension, file-count and file-size policy;
- extension + MIME validation for uploaded files;
- generated storage filenames under `DIR_STORAGE/upload/`;
- permission-protected attachment downloads;
- physical file cleanup when enquiries are deleted or anonymized;
- per-enquiry JSON GDPR export and anonymization;
- configurable retention period with bulk anonymization;
- optimized indexes for enquiry workflow and GDPR operations.

### Stable OpenCart 3 release hardening

Version `1.5.0` adds the stable-release gate for the OpenCart 3 edition:

- PHP syntax CI matrix for PHP 7.3, 7.4, 8.0, 8.1, 8.2 and 8.3;
- OCMOD XML validation;
- package source-contract checks;
- generated ZIP integrity checks;
- forbidden development-file checks;
- bilingual release-metadata validation;
- explicit compatibility and upgrade documentation;
- full storefront/admin/SEO/security regression checklist;
- documented OCMOD core-anchor review process.

PHP matrix results are syntax-level compatibility evidence. Exact production compatibility still depends on the OpenCart build, PHP stack, theme and installed modifications, so `docs/REGRESSION_CHECKLIST.md` remains the runtime acceptance gate.

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

## Upgrade notes for 1.5.0

Upgrade in place using the new package, refresh **Extensions → Modifications**, then open **Services → Settings** once to execute idempotent schema/index checks. Existing categories, services, enquiries and settings are preserved by design.

See `docs/UPGRADE.md`, `docs/COMPATIBILITY.md` and `docs/REGRESSION_CHECKLIST.md` before production deployment.

## OpenCart 4

OpenCart 4 uses a separate package and integration layer while preserving the service/category/enquiry/layout/merchandising/security domain contract. Stage 11 begins from the stable `1.5.0` OpenCart 3 contract.

## Installation

1. Download `probg-services-1.5.0.ocmod.zip` from GitHub Releases or `dist/`.
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

## Ново във версия 1.5.0

- стабилизиран release процес за OpenCart 3;
- PHP syntax CI matrix за PHP 7.3–8.3;
- автоматична OCMOD XML проверка;
- автоматични проверки на структурата и целостта на `.ocmod.zip` пакета;
- проверка за забранени development файлове;
- задължителни двуезични release notes;
- подробна compatibility документация;
- upgrade guide;
- пълен regression checklist за администрация, storefront, SEO, запитвания, сигурност и GDPR.

## Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
