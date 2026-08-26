# Upgrade guide

## General procedure

1. Back up the database and `DIR_STORAGE/upload/`.
2. Upload the new `.ocmod.zip` through **Extensions → Installer**.
3. Refresh **Extensions → Modifications**.
4. Open **Services → Settings** once to run the idempotent schema upgrade.
5. Save settings and clear the OpenCart cache if required by the active theme.
6. Verify Services landing, one category, one service, one enquiry submission and the administration Enquiries section.

## Supported upgrade paths

Stage 10 explicitly keeps additive upgrade compatibility from:

- 1.0.1
- 1.1.0
- 1.2.0
- 1.3.0
- 1.4.0

No supported upgrade path requires dropping ProBG Services tables.

## Data preservation contract

The following data must survive an upgrade:

- service categories and translations;
- services and translations;
- images, galleries and related services;
- recommended products;
- store and layout assignments;
- SEO URLs;
- enquiries, histories and assignments;
- security/GDPR configuration;
- uploaded enquiry files unless intentionally removed by delete/anonymize/retention actions.

## Post-upgrade checks

- administration menu loads without OCMOD errors;
- settings can be saved;
- category/service CRUD works;
- SEO URLs decode and rewrite correctly;
- canonical URLs are generated;
- sitemap output is valid;
- Layout Override still resolves by store;
- reusable Services Block modes render;
- enquiry form validates CAPTCHA/privacy/rate-limit/upload rules;
- secure download requires administration permission;
- GDPR export/anonymize and retention actions work;
- catalogue cache invalidates after category/service changes.

## Rollback

If an upgrade must be rolled back, restore the previous code package and the database/storage backup taken before the upgrade. Do not uninstall the extension as a rollback mechanism because uninstall intentionally preserves domain data and may not reverse additive schema changes.
