# ProBG Services for OpenCart

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)

A multilingual service catalogue and enquiry-management extension for OpenCart.

## Current version

`1.2.0`

Installation package:

`dist/probg-services-1.2.0.ocmod.zip`

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
- enquiry list, detail, statuses, assignee, internal notes and customer replies;
- BG/EN administration languages;
- per-route permissions;
- idempotent schema upgrade for new release tables.

### Public Services section

- Services landing page;
- service-category pages;
- individual service pages;
- breadcrumbs and pagination;
- galleries, pricing and related services;
- recommended OpenCart products on service pages;
- category Layout Override also inherited by service pages in that category;
- multi-store/language filtering;
- per-service enquiry forms.

### Reusable OpenCart Layout blocks

A separate **ProBG Services Block** module can be instantiated multiple times from **Extensions → Extensions → Modules** and assigned through standard OpenCart Layouts.

Modes:

- Latest services;
- Services from a selected category;
- Featured/selected services.

Each instance supports multilingual heading, limit, image dimensions and status. Featured services preserve the administrator-defined selection order.

### Enquiries

A valid enquiry is persisted to the database before email delivery is attempted. Attachments are stored under `DIR_STORAGE/upload/` using generated filenames. The administration workflow supports assignment to an active OpenCart administrator, internal notes, status changes and optional customer-facing replies. If reply email delivery fails, the workflow state remains stored.

Statuses: New, Viewed, Needs information, Quote sent, In progress, Accepted, Rejected, Completed and Spam.

### SEO and sitemap

- standard OpenCart `seo_url` records;
- hierarchical `/services/category/service` URLs;
- canonical URLs and 301 correction;
- Open Graph and Twitter Cards;
- JSON-LD `CollectionPage`, `Service`, `Offer` and `Organization`;
- dedicated Services sitemap endpoint;
- standard Google Sitemap integration;
- store/language scoped catalogue cache.

## Upgrade notes for 1.2.0

Opening **Services → Settings** after updating runs an idempotent schema check and creates the new `probg_service_product` and `probg_service_category_to_layout` tables when missing. Existing service, category and enquiry data is preserved.

## OpenCart 4

OpenCart 4 will use a separate installable package while preserving the same service/category/enquiry/layout/merchandising domain contract. See `docs/ARCHITECTURE.md` and `docs/COMPATIBILITY.md`.

## Installation

1. Download `probg-services-1.2.0.ocmod.zip` from GitHub Releases or `dist/`.
2. Upload it through **Extensions → Installer**.
3. Refresh **Extensions → Modifications**.
4. Install **ProBG Services** from **Extensions → Extensions → Modules**.
5. Open **Services → Settings** and enable the extension.
6. Create categories and services and configure sitemap/cache settings.
7. Optionally create one or more **ProBG Services Block** instances and assign them to OpenCart Layout positions.

---

# Български

## Описание

**ProBG Services** е многоезичен модул за OpenCart за управление и представяне на услуги, категории услуги и клиентски запитвания. Архитектурата следва модела на ProBG Blog, адаптиран към услуги.

## Ново във версия 1.2.0

- препоръчани продукти към всяка услуга;
- задаване на подредба на препоръчаните продукти;
- показване на продуктите на публичната страница на услугата;
- Layout Override за всяка категория и магазин;
- услугите наследяват Layout-а на категорията;
- нов reusable модул **ProBG Services Block**;
- блокове за Последни услуги, Услуги от категория и Избрани услуги;
- многоезично заглавие, лимит и размери на изображенията за всеки блок;
- автоматично безопасно създаване на новите таблици при обновяване от предишна версия.

## Запитвания

Към всяка услуга може да има собствена форма за запитване. Запитването се записва първо в базата данни, след което се изпраща email. В **Услуги → Запитвания** има списък, филтри, статуси, назначаване към администратор, вътрешни бележки, клиентски отговори и история.

## Подкрепете разработката

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Revolut-191C1F?logo=revolut&logoColor=white)](https://revolut.me/vtotev)
