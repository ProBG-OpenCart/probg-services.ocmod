# Stable OpenCart 3 regression checklist

This checklist is the release gate for Stage 10.

## Installation and upgrade

- Fresh install creates all required tables and permissions.
- Upgrade from 1.0.1, 1.1.0, 1.2.0, 1.3.0 and 1.4.0 preserves existing data.
- Opening Services → Settings runs schema checks without destructive changes.
- OCMOD refresh completes without errors.
- Installation ZIP contains only `install.xml` and `upload/` runtime files.

## Administration

- Services menu appears with Services, Categories, Enquiries and Settings according to permissions.
- Category CRUD, stores, layout overrides, SEO and filters work.
- Service CRUD, gallery, recommended products, related services, stores and SEO work.
- Enquiry filters, assignment, status history, internal notes and customer replies work.
- Secure attachment download is blocked without access permission.
- GDPR export, anonymize and retention actions behave as documented.

## Storefront

- Services landing page renders in full-page mode.
- Category and service pages render with correct breadcrumbs.
- Multi-store and language filtering works.
- Pagination works on landing/category lists.
- Prices, price text, gallery, related services and recommended products render correctly.
- Layout Override applies before standard OpenCart columns/content positions are loaded.
- Latest, Category, Featured and Services Menu module modes render through standard layouts.

## SEO and discovery

- SEO URL rewrite and decode work for section/category/service URLs.
- Wrong category/service hierarchy redirects to canonical URL with 301.
- Meta title/description/keywords are correct per language.
- Open Graph and Twitter metadata are emitted once.
- JSON-LD CollectionPage, Service, Offer, Organization and BreadcrumbList are valid JSON.
- Dedicated Services sitemap and standard Google Sitemap integration return valid XML.

## Enquiry security

- Database-first persistence occurs before mail delivery.
- Failed mail delivery never deletes the enquiry.
- CAPTCHA and privacy consent validation work.
- Honeypot rejects bot-like submissions.
- Store/IP rate limiting is enforced.
- Upload count, file size, extension and MIME policies are enforced.
- Uploaded filenames are random and stored under `DIR_STORAGE/upload/`.
- Physical files are removed on delete/anonymize.

## Cache and performance

- Catalogue reads use store/language scoped cache when enabled.
- Category/service/settings mutations invalidate the Services cache.
- Enquiry indexes exist for workflow, store/IP/date and customer/date queries.

## Release contract

- PHP syntax CI passes on 7.3, 7.4, 8.0, 8.1, 8.2 and 8.3.
- `install.xml` is valid XML.
- Version in `install.xml`, admin display, CHANGELOG, ZIP, tag and Release matches.
- CHANGELOG/Release contains complete Bulgarian and English sections.
- ZIP integrity check passes and forbidden development files are absent.
- `dist/SHA256SUMS` includes the generated package.
