# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.3.0`

Installation package:

`dist/probg-services-1.3.0.ocmod.zip`

## Editions

- OpenCart 3: active/stable development line
- OpenCart 4: planned as a separate platform-specific package using the same domain contract

## Architecture

ProBG Services follows the same core architecture proven in ProBG Blog, adapted to the service catalogue domain. It includes a full-page/module storefront controller, read-only catalogue model, standard OpenCart SEO URL integration, hierarchical canonical URLs, multi-store/language-aware queries, caching, sitemap integration, Open Graph/Twitter/JSON-LD, separate enquiry workflow, category-specific layout overrides and reusable OpenCart Layout module instances.

## Implemented

### Administration

- localized **Services** administration menu;
- Settings / Categories / Services / Enquiries navigation;
- category and service CRUD;
- gallery, pricing, SEO and related services;
- recommended products per service with explicit sort order;
- per-store Category Layout Override;
- multilingual Services landing-page SEO content;
- configurable service-provider Organization name, URL and logo;
- configurable sitemap change frequency and priorities;
- enquiry list, detail, statuses, assignee, internal notes and customer replies;
- BG/EN administration languages and per-route permissions.

### Public Services section

- Services landing page with multilingual title, description and metadata;
- service-category pages and individual service pages;
- breadcrumbs and JSON-LD `BreadcrumbList`;
- galleries, pricing, related services and recommended products;
- category Layout Override inherited by services;
- Open Graph, Twitter Cards and JSON-LD `CollectionPage`, `Service`, `Offer`, `Organization`;
- configurable provider data with store fallbacks;
- multi-store/language filtering and per-service enquiry forms.

### Reusable OpenCart Layout blocks

**ProBG Services Block** can be instantiated multiple times and assigned through standard OpenCart Layouts.

Modes:

- Latest services;
- Services from a selected category;
- Featured/selected services;
- Services menu.

Menu instances can independently show the Services home link, service categories and individual services. Content blocks support multilingual headings, limits and image dimensions.

### Enquiries

A valid enquiry is persisted to the database before email delivery is attempted. Attachments are stored under `DIR_STORAGE/upload/` using generated filenames. The administration workflow supports assignment, internal notes, status changes and optional customer-facing replies. Email failure never discards stored workflow state.

### SEO and sitemap

- standard OpenCart `seo_url` records;
- hierarchical `/services/category/service` URLs;
- canonical URLs and 301 correction;
- multilingual SEO for the Services landing page;
- Open Graph and Twitter Cards;
- JSON-LD `CollectionPage`, `Service`, `Offer`, `Organization` and `BreadcrumbList`;
- dedicated Services sitemap endpoint and standard Google Sitemap integration;
- configurable sitemap `changefreq` and separate priorities for section/category/service;
- store/language scoped catalogue cache.

## Upgrade notes

Opening **Services → Settings** runs the idempotent schema check introduced in 1.2.0. Existing service, category and enquiry data is preserved.

## OpenCart 4

OpenCart 4 will use a separate installable package while preserving the same service/category/enquiry/layout/merchandising/SEO domain contract. See `docs/ARCHITECTURE.md` and `docs/COMPATIBILITY.md`.

## Installation

1. Download `probg-services-1.3.0.ocmod.zip` from GitHub Releases or `dist/`.
2. Upload it through **Extensions → Installer**.
3. Refresh **Extensions → Modifications**.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Open **Services → Settings** and configure status, SEO, provider, sitemap and cache settings.
6. Create categories and services.
7. Optionally create **ProBG Services Block** instances for service cards or navigation menus.

---

# Български

## Описание

**ProBG Services** е многоезичен модул за OpenCart за управление и представяне на услуги, категории услуги, препоръчани продукти и клиентски запитвания. Архитектурата следва модела на ProBG Blog, адаптиран към услуги.

## Ново във версия 1.3.0

- многоезично SEO съдържание за основната страница „Услуги“;
- настройки за име, URL и лого на доставчика на услугите;
- JSON-LD `BreadcrumbList`;
- configurable sitemap `changefreq` и priority стойности;
- режим **Меню Услуги** в `ProBG Services Block`;
- отделен контрол дали менюто да показва началната страница, категориите и услугите.

## Запитвания

Към всяка услуга може да има собствена форма за запитване. Запитването се записва първо в базата данни, след което се изпраща email. В **Услуги → Запитвания** има списък, филтри, статуси, назначаване към администратор, вътрешни бележки, клиентски отговори и история.

## Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
