# Database design

ProBG Services uses dedicated tables with the active OpenCart database prefix.

## Core catalogue tables

- `probg_service_category`
- `probg_service_category_description`
- `probg_service_category_to_store`
- `probg_service_category_to_layout`
- `probg_service`
- `probg_service_description`
- `probg_service_to_store`
- `probg_service_image`
- `probg_service_related`
- `probg_service_product`

## Enquiry tables

- `probg_service_enquiry`
- `probg_service_enquiry_file`
- `probg_service_enquiry_history`

## Catalogue relation tables

`probg_service_category_to_layout` stores an optional OpenCart Layout Override by `(category_id, store_id)`.

`probg_service_product` stores recommended products by `(service_id, product_id)` with explicit `sort_order`.

## Enquiry persistence

The enquiry record stores store/service/customer references, contact data, message content, budget/deadline, workflow status, assigned administrator, IP, user agent, email-delivery state and timestamps.

An enquiry is committed before notification email is attempted. A mail error never removes an otherwise valid enquiry.

## Stage 9 performance indexes

Version `1.4.0` adds these idempotent indexes to `probg_service_enquiry`:

- `assigned_status_date (assigned_user_id, status_id, date_added)` — administration workflow/filter support;
- `store_ip_date (store_id, ip, date_added)` — rate-limit lookup;
- `customer_date (customer_id, date_added)` — customer/GDPR lookup preparation.

`ensureSchema()` uses `SHOW INDEX` and adds only missing indexes, so existing installations can upgrade without reinstalling.

## GDPR data lifecycle

A normal enquiry retains all submitted data and its attachments.

An anonymized enquiry retains the minimal operational record (ID, store/service relationship, workflow status/history and timestamps) while personal/contact/content data is removed. File records and physical uploaded files are deleted.

Deleting an enquiry removes its history, file records, physical uploaded files and the enquiry record itself.

## Upgrade behavior

Additive tables and indexes are applied idempotently when **Services → Settings** opens. Existing service, category and enquiry records are preserved.

## Data integrity

- Relationships are maintained by application logic for broad OpenCart compatibility.
- Indexes cover catalogue sorting, store/language filtering, layout/product lookup, enquiry workflow, rate limiting and customer/date queries.
- Uploaded files are stored outside executable paths and referenced from the database.
- Uninstall preserves tables and business data; destructive removal requires an explicit purge action.
