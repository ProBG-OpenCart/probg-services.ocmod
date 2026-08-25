# Changelog

All notable changes to ProBG Services are documented in this file.

## [1.1.0] - 2026-08-25

### Български

#### Добавено
- Назначаване на всяко запитване към конкретен активен администратор на OpenCart.
- Филтър по назначен администратор, включително неназначени запитвания.
- Показване на назначения администратор в списъка и детайлния изглед.
- Възможност бележката да остане само вътрешна или да бъде изпратена като отговор до клиента.
- Имейл отговор до клиента директно от детайлния изглед на запитването.
- `notify` маркер в историята за разграничаване на вътрешни бележки и изпратени клиентски отговори.
- Отделни съобщения при успешно изпратен отговор и при запазен запис с неуспешно изпращане на email.
- Български текстове за новия workflow и email шаблона за отговор.

#### Променено
- Етапът на разработка е преместен на Етап 6.
- Версията на модула е увеличена до `1.1.0` като backward-compatible feature release.
- Историята на запитването вече показва администратор и дали записът е изпратен до клиента.

#### Архитектурни решения
- Използват се вече съществуващите `assigned_user_id` и `notify` полета, без breaking промяна на database schema.
- Клиентският отговор първо се записва в workflow историята; при email грешка обработката на запитването остава запазена.

### English

#### Added
- Assignment of each enquiry to a specific active OpenCart administrator.
- Assignee filter including unassigned enquiries.
- Assigned administrator shown in list and detail views.
- Notes can remain internal or be sent as a customer reply.
- Direct customer email replies from the enquiry detail page.
- `notify` history flag distinguishes internal notes from customer-facing replies.
- Separate success messaging for delivered replies and saved updates where email delivery failed.
- English workflow labels and customer reply email template.

#### Changed
- Development stage advanced to Stage 6.
- Module version increased to `1.1.0` as a backward-compatible feature release.
- Enquiry history now shows the administrator and whether each entry was sent to the customer.

#### Architecture decisions
- Existing `assigned_user_id` and `notify` fields are reused, avoiding a breaking database-schema migration.
- Customer reply workflow remains durable when email delivery fails; enquiry processing state is still preserved.

## [1.0.1] - 2026-08-25

### Български

#### Добавено
- Публична начална страница „Услуги“ по full-page controller модела на ProBG Blog.
- Публични страници на категории услуги с пагинация и многоезично съдържание.
- Самостоятелни страници на услуги с основно изображение, галерия, цена и свързани услуги.
- Отделен read-only catalog model за категории, услуги, галерии, свързани услуги и sitemap данни.
- Catalog кеширане по магазин и език.
- Правила за скриване на изключени услуги и услуги с бъдеща дата на публикуване.
- Йерархични SEO route ключове `probg_service_category_id` и `probg_service_id`.
- Canonical URL и HTTP 301 корекция при заявена услуга през грешна категория.
- Open Graph и Twitter Card метаданни за страниците на услугите.
- JSON-LD `CollectionPage` за списъци и категории.
- JSON-LD `Service`, `Offer` и `Organization` за страниците на услуги.
- Самостоятелен `extension/feed/probg_services_sitemap` endpoint.
- Интеграция със стандартния OpenCart Google Sitemap.
- Sitemap филтриране по магазин и език.
- Български и английски storefront езикови файлове.
- Bootstrap-ориентирани Twig шаблони за списък, категория, услуга, module block и 404.
- Настройки за брой услуги на страница, sitemap и кеширане.
- Публична форма за запитване към всяка услуга, за която запитванията са включени.
- Полета за име, имейл, телефон, фирма, уебсайт, тема, бюджет, желан срок и съобщение.
- Проверка за съгласие с поверителност, honeypot anti-spam и стандартна OpenCart CAPTCHA интеграция.
- До пет файла към запитване с лимит 5 MB на файл и ограничен списък с разширения.
- Database-first записване: валидното запитване се записва преди опита за изпращане на email.
- Отделно поле `email_sent`, така че SMTP грешка да не загуби запитването.
- История за създаването на запитването и резултата от email известяването.
- Свързване на запитването с клиент, услуга, магазин, IP адрес и user agent.
- Отделна административна секция **Запитвания**.
- Филтри по клиент, имейл, ID на услуга, статус и период.
- Детайлен изглед със заявените данни, файловете и пълната история.
- Статуси: Ново, Прегледано, Изисква информация, Изпратена оферта, В процес, Прието, Отказано, Приключено и Спам.
- Вътрешни бележки и история на промените на статуса.
- Dashboard брояч за запитванията.
- Локализиран пункт **Запитвания** в административното меню.
- Български и английски езикови файлове за публичната форма и администрацията.

#### Променено
- Публичната архитектура е уеднаквена с доказания модел на ProBG Blog, но със service-domain семантика.
- OCMOD разширява стандартния OpenCart SEO URL decoder/rewriter за категории услуги и услуги.
- OCMOD добавя социалните метаданни на Services в общия theme header по модела на ProBG Blog.
- Административната навигация вече е **Настройки / Категории / Услуги / Запитвания**.
- Версията на модула и OCMOD metadata е `1.0.1`.
- Индикаторът за разработка е преместен на Етап 5.

#### Сигурност
- Файловете от запитванията се записват в `DIR_STORAGE/upload/` със случайно генерирани имена вместо оригиналното клиентско име.
- Изпълними и script разширения не се приемат от uploader-а.
- Формата проверява задължителните данни, съгласието за поверителност, honeypot полето и OpenCart CAPTCHA, когато е включена.

#### Архитектурни решения
- Страниците на услуги използват Schema.org `Service`/`Offer` вместо blog-specific schema типове.
- Публичният catalog read layer остава отделен от enquiry write layer-а.
- Запитванията се записват независимо от успешното изпращане на email.
- Файловете и историята на запитванията използват отделни таблици.
- OpenCart 4 остава отделен integration layer със същия domain contract.

### English

#### Added
- Public Services landing page following the ProBG Blog full-page controller pattern.
- Public service-category pages with pagination and multilingual content.
- Individual service pages with main image, gallery, price display and related services.
- Dedicated read-only catalog model for categories, services, galleries, related services and sitemap data.
- Store/language scoped catalog cache keys.
- Publication rules for disabled and future-dated services.
- Hierarchical SEO route keys `probg_service_category_id` and `probg_service_id`.
- Canonical URLs and HTTP 301 correction when a service is requested under the wrong category.
- Open Graph and Twitter Card output for Services pages.
- JSON-LD `CollectionPage` for listing/category pages.
- JSON-LD `Service`, `Offer` and `Organization` provider data for service pages.
- Dedicated `extension/feed/probg_services_sitemap` endpoint.
- Integration with the standard OpenCart Google Sitemap.
- Store/language-aware sitemap filtering.
- Bulgarian and English storefront language files.
- Bootstrap-oriented Twig templates for listing, category, service, module and not-found output.
- Services-per-page, sitemap and cache settings in administration.
- Public enquiry form on every service where enquiries are enabled.
- Enquiry fields for name, email, telephone, company, website, subject, budget, desired deadline and message.
- Privacy consent validation, honeypot anti-spam field and standard OpenCart CAPTCHA integration.
- Up to five enquiry attachments with a 5 MB per-file limit and restricted extension list.
- Database-first enquiry persistence: valid enquiries are stored before email notification is attempted.
- Separate `email_sent` state so SMTP failure cannot discard an enquiry.
- Enquiry history entries for creation and notification outcome.
- Customer, service, store, IP and user-agent association for enquiries.
- Dedicated **Enquiries** administration section.
- Enquiry list with filters by customer, email, service ID, status and date range.
- Enquiry detail page with submitted data, attachment metadata and complete history.
- Enquiry workflow statuses: New, Viewed, Needs information, Quote sent, In progress, Accepted, Rejected, Completed and Spam.
- Internal notes and status history updates from administration.
- Enquiry counter tile on the ProBG Services administration dashboard.
- Localized **Enquiries** entry in the ProBG Services administration menu.
- Bulgarian and English enquiry storefront/admin language files.

#### Changed
- Core storefront architecture aligned with the proven ProBG Blog architecture while preserving service-domain semantics.
- OCMOD extends the standard OpenCart SEO URL decoder/rewriter for service categories and services.
- OCMOD injects Services social metadata into the common theme header using the same integration strategy as ProBG Blog.
- Administration navigation now includes **Settings / Categories / Services / Enquiries**.
- Module metadata, administration version and OCMOD version set to `1.0.1`.
- Stage indicator advanced to Stage 5.

#### Security
- Enquiry uploads are stored in `DIR_STORAGE/upload/` using random generated filenames instead of the original client filename.
- Executable/script extensions are not accepted by the enquiry uploader.
- Enquiry form validation includes required identity/contact/message fields, privacy consent, honeypot protection and optional OpenCart CAPTCHA.

#### Architecture decisions
- Service pages use Schema.org `Service`/`Offer` rather than blog-specific schemas.
- Public service catalogue reads remain separated from the enquiry write model.
- Enquiry persistence is database-first and independent of email delivery status.
- Enquiry files and history use dedicated tables to keep workflow extensible.
- OpenCart 4 remains a separate integration layer sharing the same domain contract.

## [0.3.2-dev] - 2026-08-14

### Added
- Administration root menu follows the ProBG Blog pattern: localized root label, individually permissioned child entries, and insertion before Design.
- Bulgarian root menu label changed to **Услуги** and English root menu label to **Services**.

### Changed
- Services menu implementation normalized to the same compact OCMOD structure used by ProBG Blog.

## [0.3.1-dev] - 2026-08-14

### Added
- Unified administration navigation modeled after ProBG Blog: **Settings / Categories / Services**.
- Shared top-level section tabs on settings, category list/form and service list/form pages.
- Dashboard tiles showing total service categories and services.
- Localized administration menu labels and shared internal routes.

## [0.3.0-dev] - 2026-08-07

### Added
- Full services administration CRUD and bulk delete.
- Multilingual title, subtitle, descriptions, price text, enquiry button text and SEO metadata.
- Category, main image, social image, price, Show price, enquiry toggle, publication date, sort order and status.
- Multi-store service assignment.
- Service gallery and related services.
- Filters, pagination and automatic service SEO URLs.

## [0.2.0-dev] - 2026-08-07

### Added
- Full OpenCart 3 administration CRUD for service categories.
- Multi-language category content and SEO metadata.
- Parent categories, image/icon, multi-store, status, sort order, filters and pagination.
- Standard OpenCart `seo_url` integration and automatic transliterated SEO URLs.

## [0.1.0-dev] - 2026-08-06

### Added
- Initial OpenCart 3 extension structure and install lifecycle.
- Database foundation for categories, services, galleries, relations, enquiries, files and history.
- Administrator permissions, BG/EN languages, settings and Features tab.
- README and technical documentation plus OpenCart 4 porting strategy.

### Design decisions
- Uninstall preserves business and enquiry data by default.
- OpenCart 3 and OpenCart 4 are distributed as separate packages.
- Enquiries are stored independently of email delivery status.
