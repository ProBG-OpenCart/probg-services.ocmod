# Architecture

## Product editions

The extension will have separate installable packages for OpenCart 3 and OpenCart 4. Business concepts, setting keys and database entities remain aligned, while controllers, events, namespaces and installer integration remain platform-specific.

## Administrative sections

- Dashboard
- Categories
- Services
- Enquiries
- Email templates
- Settings
- Features / development status

## Enquiry persistence rule

An enquiry is written to the database before notification email is attempted. Email failure must not discard or roll back a valid enquiry. Delivery result is recorded separately.

## Compatibility boundary

Shared concepts:
- Database entities
- Validation rules
- Status model
- SEO rules
- Enquiry workflow
- Language keys where practical

Platform-specific layers:
- Controllers and routes
- Events
- Installer/package format
- Namespaces
- Administration UI integration
- Theme/template integration
