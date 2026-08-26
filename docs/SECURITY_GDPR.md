# Security and GDPR

## Scope

Version 1.4.0 introduces the first complete security and privacy-management layer for the ProBG Services enquiry subsystem.

## Enquiry abuse protection

Public enquiries retain the existing honeypot and optional OpenCart CAPTCHA validation. In addition, requests are rate-limited by `(store_id, IP address)` using the persisted enquiry records.

Settings:

- `module_probg_services_rate_limit_count`
- `module_probg_services_rate_limit_minutes`

The supporting `store_ip_date` index keeps the lookup bounded for larger enquiry tables.

## Upload policy

Settings:

- maximum file count: 0–10;
- maximum size per file: 1–25 MB;
- comma/space/semicolon separated extension allow-list.

The module accepts only file extensions for which it has an explicit safe MIME mapping. A file must pass:

1. PHP upload status;
2. `is_uploaded_file()`;
3. configured file-size limit;
4. configured extension allow-list;
5. known MIME mapping for that extension;
6. MIME validation when the server exposes `mime_content_type()`.

Accepted files are renamed using cryptographically random filenames and stored under `DIR_STORAGE/upload/`.

## Secure download

Attachments are not linked directly to their storage path. Administrators download them through `extension/probg_services/enquiry/download`, which requires access permission to the Enquiries route and resolves the stored filename from the database.

## Deletion and file lifecycle

Deleting an enquiry removes:

- physical uploaded files;
- file records;
- history records;
- the enquiry record.

Anonymizing an enquiry deletes physical files/file records but preserves a minimal operational record and workflow history.

## GDPR export

`extension/probg_services/enquiry/export` returns a JSON file containing the enquiry, file metadata and history. It is read-only and does not modify workflow state.

## GDPR anonymization

Anonymization removes or resets:

- customer ID;
- name;
- email;
- telephone;
- company;
- website;
- subject;
- message;
- budget;
- desired deadline;
- IP address;
- user agent;
- uploaded files.

The enquiry ID, service/store relationship, status and workflow history remain available for operational/statistical continuity.

## Retention

`module_probg_services_retention_days` defines the age threshold used by the manual retention action in Services → Settings → Security and GDPR.

The retention action anonymizes all non-anonymized enquiries older than the configured threshold.

## Performance and indexes

Version 1.4.0 adds idempotent indexes:

- `assigned_status_date (assigned_user_id, status_id, date_added)`;
- `store_ip_date (store_id, ip, date_added)`;
- `customer_date (customer_id, date_added)`.

They are created by `ensureSchema()` for existing installations.

## Cache invalidation

The `probg_services` catalogue cache is invalidated after category and service create/edit/delete operations and after global module settings are saved. Enquiry records are never stored in the public catalogue cache.
