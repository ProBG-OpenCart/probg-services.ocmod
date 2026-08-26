# Compatibility

## OpenCart 3 stable line

Primary target family:

- OpenCart 3.0.2.x
- OpenCart 3.0.3.x

The extension uses the standard OpenCart 3 MVC-L structure, Twig templates, `user_token`, `seo_url`, Layout modules and OCMOD only for core integration points that cannot be provided cleanly by the extension routes alone.

### Compatibility levels

`Supported` means the module architecture and package format target that OpenCart family.

`CI syntax validated` means every PHP file parses successfully on the listed PHP interpreter. It does not by itself guarantee that an unmodified OpenCart core supports that PHP interpreter.

`Runtime verified` must only be added after installation and regression testing on a real OpenCart instance.

## PHP CI matrix

Every pull request is syntax-validated on:

- PHP 7.3
- PHP 7.4
- PHP 8.0
- PHP 8.1
- PHP 8.2
- PHP 8.3

This matrix catches language-level incompatibilities in ProBG Services. The PHP versions supported by a particular store still depend on that store's OpenCart core and PHP compatibility patches.

## OpenCart 3 integration contract

The stable package expects these standard OpenCart 3 contracts:

- `admin/controller/common/column_left.php`
- `catalog/controller/startup/seo_url.php`
- `catalog/controller/common/header.php`
- `catalog/view/theme/*/template/common/header.twig`
- `catalog/controller/extension/feed/google_sitemap.php`
- standard `seo_url`, `layout`, `module`, `user`, `store`, `language` and product tables
- `DIR_STORAGE/upload/` for protected enquiry attachments

All OCMOD operations that are optional cross-version integrations use `error="skip"` where appropriate so a non-matching optional core fragment does not make the whole modification unusable.

## Upgrade compatibility

The schema strategy is additive and idempotent. Opening **Services → Settings** runs `ensureSchema()` and preserves existing service, category and enquiry data.

Upgrade paths covered by the Stage 10 regression contract:

- 1.0.1 → current
- 1.1.0 → current
- 1.2.0 → current
- 1.3.0 → current
- 1.4.0 → current

Uninstall intentionally preserves business data. Destructive cleanup is never performed implicitly.

## OpenCart 4

OpenCart 4 remains a separate package and integration layer. It will use namespaces, OpenCart 4 installer conventions, event-based integration and Bootstrap 5 compatible administration views while preserving the same service/category/enquiry domain semantics where practical.
