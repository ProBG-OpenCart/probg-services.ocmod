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

## Stage 7 additions

### `probg_service_category_to_layout`

Stores the optional OpenCart Layout Override for a service category per store.

Primary key:

`(category_id, store_id)`

Fields:

- `category_id`
- `store_id`
- `layout_id`

A missing row or `layout_id = 0` means OpenCart uses its normal route layout resolution.

### `probg_service_product`

Stores recommended OpenCart products for each service.

Primary key:

`(service_id, product_id)`

Fields:

- `service_id`
- `product_id`
- `sort_order`

The relation is deliberately separate from the service table so products remain queryable and can have explicit ordering.

## Enquiry persistence

The enquiry record includes store, service, customer identity, contact details, message, budget, requested deadline, status, assigned administrator, IP, user agent, email-delivery state and timestamps.

An enquiry is committed before notification email is attempted. A mail error never removes an otherwise valid enquiry.

## Upgrade behavior

Version `1.2.0` introduces idempotent schema upgrades through `ensureSchema()`. Opening **Services → Settings** executes `CREATE TABLE IF NOT EXISTS` statements, allowing an existing installation to receive additive tables without uninstall/reinstall and without deleting existing data.

## Data integrity

- Relationships are maintained by application logic for broad OpenCart compatibility.
- Indexes cover category/status sorting, service/status/date filtering, store, email, layout lookup, product lookup and enquiry history.
- Uploaded files are stored outside executable paths and referenced from the database.
- Uninstall preserves tables and business data; destructive removal requires an explicit purge action.
