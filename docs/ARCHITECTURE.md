# ProBG Services Architecture

## Architecture baseline

ProBG Services follows the proven OpenCart 3 architecture used by **ProBG Blog**, while replacing publishing concepts with service-catalogue and enquiry-management concepts.

| ProBG Blog | ProBG Services |
| --- | --- |
| Blog home | Services landing page |
| Blog category | Service category |
| Article | Service |
| Article gallery | Service gallery |
| Related products | Recommended products per service |
| Category Layout Override | Service Category Layout Override |
| Blog module instances | ProBG Services Block instances |
| BlogPosting schema | Service + Offer schema |
| Blog/CollectionPage schema | CollectionPage for service listings/categories |
| Blog sitemap | Services sitemap |
| Blog catalogue cache | Services catalogue cache |

## Runtime layers

### Administration layer

Routes are isolated under:

- `extension/module/probg_services` — global settings/dashboard and schema upgrade entrypoint;
- `extension/module/probg_services_block` — reusable OpenCart Layout block instances;
- `extension/probg_services/category` — category CRUD and per-store Layout Override;
- `extension/probg_services/service` — service CRUD, related services and recommended products;
- `extension/probg_services/enquiry` — enquiry workflow.

### Catalogue data layer

`catalog/model/extension/probg_services/service.php` owns active category/service lookup, language/store filtering, publication rules, gallery data, related services, recommended-product IDs, Category Layout Override resolution, sitemap data and store/language scoped cache keys.

### Catalogue controller layer

`catalog/controller/extension/module/probg_services.php` uses the same full-page/module dual-mode pattern as ProBG Blog. Category and service pages apply the selected category Layout Override by setting `config_layout_id` before OpenCart renders the layout columns.

`catalog/controller/extension/module/probg_services_block.php` is a separate reusable block renderer. It supports three modes:

- latest services;
- services from one category;
- explicitly selected/featured services.

Each block is stored as a normal OpenCart module instance and can therefore be assigned to standard Layout positions independently.

## Merchandising boundary

Recommended products use a dedicated many-to-many table rather than service JSON/settings. This keeps product references queryable and preserves explicit sort order. Product cards reuse the standard OpenCart product model for availability, pricing, tax, special price and rating semantics.

## Layout override boundary

Service category Layout Overrides use a dedicated `{DB_PREFIX}probg_service_category_to_layout` table keyed by `(category_id, store_id)`, matching the ProBG Blog approach. A service inherits the Layout Override of its owning category. A zero/missing override falls back to OpenCart's normal route layout resolution.

## Public URL contract

Logical route: `extension/module/probg_services`

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

- Meta Title / Description / Keywords;
- canonical URLs;
- Open Graph;
- Twitter Cards;
- JSON-LD `CollectionPage`;
- JSON-LD `Service`;
- JSON-LD `Offer` when a visible price is available;
- `Organization` as service provider.

## Sitemap architecture

Dedicated endpoint: `index.php?route=extension/feed/probg_services_sitemap`

The sitemap contains the Services landing page, active service categories assigned to the current store/language, and active/published services assigned to the current store/language. The same nodes can be injected into OpenCart's standard Google Sitemap feed.

## Cache architecture

Catalogue cache keys use:

```text
probg_services.<store_id>.<language_id>.<resource>
```

Enquiries are never cached.

## Enquiry persistence boundary

A valid enquiry is committed before email notification is attempted. Delivery failure never discards the enquiry. Enquiry data, files and workflow history remain in dedicated tables.

## Schema upgrade strategy

From version `1.2.0`, the administration settings controller calls an idempotent `ensureSchema()` method. `CREATE TABLE IF NOT EXISTS` migrations allow existing installations to gain new additive tables without uninstalling the module or deleting business data.

## OpenCart 4 boundary

OpenCart 3 and OpenCart 4 use separate install packages. Shared domain concepts include database entities, validation rules, SEO semantics, service/category/enquiry workflow, merchandising relations, layout override semantics, cache resources and sitemap data. Platform-specific controllers, namespaces, events, installer structure and UI remain isolated.
