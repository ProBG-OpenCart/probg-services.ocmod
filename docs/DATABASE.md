# Database design

Stage 1 creates the following tables with the active OpenCart database prefix:

- `probg_service_category`
- `probg_service_category_description`
- `probg_service_category_to_store`
- `probg_service`
- `probg_service_description`
- `probg_service_to_store`
- `probg_service_image`
- `probg_service_related`
- `probg_service_enquiry`
- `probg_service_enquiry_file`
- `probg_service_enquiry_history`

Later stages will add FAQ and email-template tables when their administration workflows are implemented.

## Enquiry persistence

The enquiry record includes store, service, customer identity, contact details, message, budget, requested deadline, status, assigned administrator, IP, user agent, email-delivery state, and timestamps.

An enquiry must be committed to the database before notification email is attempted. A mail error must never remove an otherwise valid enquiry.

## Data integrity

- Relationships are maintained by application logic for broad OpenCart compatibility.
- Indexes cover category/status sorting, service/status/date filtering, store, email, and enquiry history.
- Uploaded files will be stored outside executable paths and referenced from the database.
- Uninstall preserves tables and business data; destructive removal will require an explicit purge action.
