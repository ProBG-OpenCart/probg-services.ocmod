# ProBG Services Architecture

## Architecture baseline

ProBG Services follows the proven OpenCart 3 architecture used by **ProBG Blog**, while replacing publishing concepts with service-catalogue and enquiry-management concepts.

The architectural mapping is:

| ProBG Blog | ProBG Services |
| --- | --- |
| Blog home | Services landing page |
| Blog category | Service category |
| Article | Service |
| Article gallery | Service gallery |
| Related products | Related services; product recommendations remain optional |
| BlogPosting schema | Service + Offer schema |
| Blog/CollectionPage schema | CollectionPage for service listings/categories |
| Blog sitemap | Services sitemap |
| Blog catalogue cache | Services catalogue cache |

## Runtime layers

### Administration layer

Routes are isolated under:

- `extension/module/probg_services` — global settings/dashboard;
- `extension/probg_services/category` — category CRUD;
- `extension/probg_services/service` — service CRUD;
- `extension/probg_services/enquiry` — enquiry workflow (next domain stage).

The administration navigation mirrors ProBG Blog: localized root menu, per-route permission checks, shared Settings / Categories / Services navigation, and dashboard counters.

### Catalogue data layer

`catalog/model/extension/probg_services/service.php` is the read-only storefront domain model. It owns:

- active category lookup;
- active/published service lookup;
- language filtering;
- store filtering;
- service counts;
- gallery retrieval;
- related service retrieval;
- sitemap data;
- store/language scoped cache keys.

Catalogue queries do not expose disabled services or services with a future `date_available`.

### Catalogue controller layer

`catalog/controller/extension/module/probg_services.php` uses the same dual-mode pattern as ProBG Blog:

1. **Full-page mode** when the route represents the Services landing page, a category, or a service.
2. **Layout module mode** when OpenCart renders the extension as a module instance.

This avoids separate public controllers for landing/category/service pages while keeping one canonical domain route.

## Public URL contract

Logical route:

`extension/module/probg_services`

Entity query keys:

- `probg_service_category_id=<id>`
- `probg_service_id=<id>`

The OCMOD integration teaches the standard OpenCart `startup/seo_url.php` decoder/rewriter about those keys. SEO values remain in the standard `{DB_PREFIX}seo_url` table.

Canonical hierarchy:

```text
/services
/services/category
/services/category/service
```

A service requested through the wrong category path is redirected with HTTP 301 to its canonical category/service URL.

## SEO presentation layer

The architecture mirrors ProBG Blog but uses service semantics:

- Meta Title / Description / Keywords;
- canonical URLs;
- Open Graph;
- Twitter Cards;
- JSON-LD `CollectionPage` for listings/categories;
- JSON-LD `Service` for a service;
- JSON-LD `Offer` when a visible price is available;
- `Organization` as the service provider.

The service `social_image` is preferred for social previews, with the main service image as fallback.

## Sitemap architecture

Dedicated endpoint:

`index.php?route=extension/feed/probg_services_sitemap`

The sitemap contains:

- Services landing page;
- active service categories assigned to the current store/language;
- active and published services assigned to the current store/language.

When enabled, the same URL nodes are injected into OpenCart's standard Google Sitemap feed.

## Cache architecture

Catalogue cache keys follow the Blog strategy:

```text
probg_services.<store_id>.<language_id>.<resource>
```

Cached resources include category lists, category pages, service lists, service pages, galleries and sitemap data. Enquiries are never cached.

## Enquiry persistence boundary

The enquiry subsystem is intentionally separated from catalogue reads.

A valid enquiry must be committed to the database **before** email notification is attempted. Email delivery failure must never discard the enquiry. Delivery status is recorded separately.

The enquiry domain uses dedicated tables for enquiry data, files and history, allowing the later administration workflow to evolve without coupling it to the public catalogue model.

## OpenCart 4 boundary

OpenCart 3 and OpenCart 4 use separate install packages. Shared concepts remain stable:

- database entities;
- validation rules;
- SEO URL domain semantics;
- service/category/enquiry workflow;
- cache resource semantics;
- sitemap resource model;
- language keys where practical.

Platform-specific code remains isolated to controllers, namespaces, events, installer format, admin UI integration and Twig/theme integration.
