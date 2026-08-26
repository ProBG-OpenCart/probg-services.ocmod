# OpenCart 4 architecture

## Goal

Port the stable OpenCart 3 domain contract from ProBG Services 1.5.0 to OpenCart 4 without reusing OpenCart 3 controller/model integration code directly.

## Package boundary

OpenCart 3 remains rooted in `upload/` plus root `install.xml` and is packaged as:

`probg-services-<version>.ocmod.zip`

OpenCart 4 is developed under `opencart4/` and will be packaged separately as:

`probg-services-opencart4-<version>.ocmod.zip`

The OpenCart 4 package root contains `install.json`, `admin/`, `catalog/` and, only where no stable event hook exists, `ocmod/`.

## Namespace contract

Extension code: `probg_services`.

Admin controller namespace:

`Opencart\Admin\Controller\Extension\ProbgServices\...`

Catalog controller namespace:

`Opencart\Catalog\Controller\Extension\ProbgServices\...`

Models follow the corresponding OpenCart 4 Admin/Catalog extension namespaces.

## Domain parity

The OpenCart 4 edition must preserve the functional semantics of the stable OpenCart 3 line:

- multilingual service categories;
- multilingual services;
- multi-store assignments;
- galleries and social images;
- pricing and optional price visibility;
- related services and recommended products;
- service enquiries and durable workflow history;
- secure attachments, rate limiting, GDPR export/anonymization and retention;
- reusable service blocks/menu mode;
- per-store layout behavior where the OpenCart 4 layout API supports it;
- SEO URLs, canonical URLs, Open Graph/Twitter and JSON-LD;
- sitemap integration and cache invalidation.

## Integration strategy

Prefer OpenCart 4 Events over core modifications. OCMOD is allowed only when no stable event or extension API can provide equivalent behavior. Every OCMOD operation must be documented with the target core path and compatibility rationale.

## Database strategy

The OpenCart 4 edition keeps the same logical table schema and `DB_PREFIX` naming as the OpenCart 3 edition wherever practical. This is intentional so a store migration can preserve service/enquiry business data while replacing the platform integration layer.

Database installation and additive upgrades must remain idempotent. Uninstall preserves business and enquiry data by default.

## Administration UI

OpenCart 4 administration views use Bootstrap 5-compatible markup and native OpenCart 4 form/navigation conventions. The intended navigation remains:

- Services
- Categories
- Enquiries
- Settings

## Release strategy

OpenCart 4 artifacts are validated and released separately from the OpenCart 3 `.ocmod.zip`. The release workflow must never package the `opencart4/` development source inside the OpenCart 3 installer.

The initial OpenCart 4 development version is `2.0.0-dev`. A stable OpenCart 4 version will only be published after installer, admin, storefront, SEO, enquiry and upgrade regression checks pass on supported OpenCart 4 builds.
