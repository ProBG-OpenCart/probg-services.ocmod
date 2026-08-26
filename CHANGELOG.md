# Changelog

All notable changes to ProBG Services are documented in this file.

## [1.4.0] - 2026-08-26

### Български

#### Добавено
- Configurable rate limiting за публичните запитвания по магазин и IP адрес.
- Настройки за максимален брой запитвания и период в минути.
- Configurable upload policy: максимален брой файлове, максимален размер и разрешени разширения.
- MIME проверка според разширението за поддържаните файлови типове.
- Secure attachment download през permission-protected административен route, без директно излагане на storage пътя.
- GDPR JSON export за конкретно запитване, включително metadata за файлове и история.
- GDPR анонимизиране на конкретно запитване.
- Retention настройка в дни и ръчно анонимизиране на всички по-стари запитвания.
- Idempotent database индекси `assigned_status_date`, `store_ip_date` и `customer_date` за workflow, rate limiting и GDPR операции.
- Нов административен таб **Сигурност и GDPR**.

#### Променено
- При изтриване или анонимизиране на запитване физическите файлове вече се изтриват от `DIR_STORAGE/upload/`.
- Cache-ът `probg_services` се изчиства автоматично след добавяне, редакция или изтриване на категория/услуга и при запис на глобалните настройки.
- Upload validation вече проверява разширение, размер и MIME type преди преместване на файла.
- Версията е увеличена до `1.4.0`, development stage е преместен на Етап 9.

#### Сигурност
- Rate limiting намалява автоматизирания spam дори когато CAPTCHA не е активна.
- Имената на качените файлове остават случайно генерирани и файловете се пазят извън executable web paths.
- Secure download изисква OpenCart admin permission за секцията Запитвания.
- Retention/anonymization премахва име, email, телефон, фирма, web адрес, съдържание на запитването, IP и user agent.

#### Архитектурни решения
- GDPR export е read-only операция и не променя workflow history.
- Anonymization запазва минималния operational record и status history, но премахва личните данни и файловете.
- Rate limiting използва съществуващата enquiry таблица и оптимизиран composite index вместо отделен volatile storage layer.

### English

#### Added
- Configurable storefront enquiry rate limiting scoped by store and IP address.
- Settings for maximum enquiry count and time window in minutes.
- Configurable upload policy: maximum files, maximum file size and allowed extensions.
- MIME validation matched to supported file extensions.
- Secure attachment downloads through a permission-protected administration route without exposing storage paths.
- GDPR JSON export for an individual enquiry including file metadata and workflow history.
- GDPR anonymization for an individual enquiry.
- Configurable retention period and manual anonymization of all older enquiries.
- Idempotent `assigned_status_date`, `store_ip_date` and `customer_date` database indexes for workflow, rate limiting and GDPR operations.
- New **Security and GDPR** administration tab.

#### Changed
- Physical uploaded files are deleted when an enquiry is deleted or anonymized.
- The `probg_services` cache is invalidated automatically after category/service mutations and global settings changes.
- Upload validation now checks extension, size and MIME type before moving a file into storage.
- Version increased to `1.4.0` and development stage advanced to Stage 9.

#### Security
- Rate limiting reduces automated spam even when CAPTCHA is not enabled.
- Uploaded files continue to use random generated storage filenames outside executable web paths.
- Secure download requires OpenCart administration permission for Enquiries.
- Retention/anonymization removes name, email, telephone, company, website, enquiry content, IP address and user agent.

#### Architecture decisions
- GDPR export is read-only and does not mutate workflow history.
- Anonymization preserves the minimal operational record and status history while removing personal data and files.
- Rate limiting reuses the enquiry table with a dedicated composite index instead of a separate volatile storage layer.

## [1.3.0] - 2026-08-25

### Български

#### Добавено
- Многоезични SEO настройки за основната страница „Услуги“: заглавие, описание, Meta Title, Meta Description и Meta Keywords.
- Конфигурируеми данни за доставчика на услугите: име, URL и лого.
- JSON-LD `BreadcrumbList` за началната страница, категориите и услугите.
- `Organization` provider данните в Schema.org `Service` вече използват настройките на модула с fallback към магазина.
- Настройки за sitemap `changefreq`.
- Отделни sitemap priority стойности за секцията, категориите и услугите.
- Нов режим **Меню Услуги** в reusable `ProBG Services Block`.
- В menu mode могат независимо да се показват началната страница „Услуги“, категориите и услугите.
- Нов storefront Twig шаблон за Services menu instances.

#### Променено
- Основната публична страница използва конфигурираното многоезично SEO съдържание вместо фиксирано заглавие.
- Sitemap endpoint-ът и стандартната Google Sitemap интеграция използват конфигурируемите `changefreq` и priority стойности.
- Версията е увеличена до `1.3.0`, а development stage е преместен на Етап 8.

#### Архитектурни решения
- Provider конфигурацията е глобална за магазина и се използва централизирано от Service structured data.
- Breadcrumb structured data се генерира от същия breadcrumb масив, който се използва във визуалната навигация, за да няма разминаване.
- Menu instances използват съществуващия Layout module contract вместо нов паралелен extension type.

### English

#### Added
- Multilingual Services landing-page SEO settings: title, description, Meta Title, Meta Description and Meta Keywords.
- Configurable service-provider name, URL and logo.
- JSON-LD `BreadcrumbList` for landing, category and service pages.
- Schema.org `Service` provider `Organization` now uses module settings with store fallbacks.
- Configurable sitemap `changefreq`.
- Separate sitemap priorities for the Services section, categories and services.
- New **Services menu** mode in the reusable `ProBG Services Block`.
- Menu instances can independently show Services home, categories and individual services.
- New storefront Twig template for Services menu instances.

#### Changed
- The public Services landing page now uses configured multilingual SEO content instead of a fixed heading.
- Dedicated and standard Google Sitemap output use configurable change frequency and priorities.
- Version increased to `1.3.0` and development stage advanced to Stage 8.

#### Architecture decisions
- Provider configuration is store-global and centrally reused by Service structured data.
- Breadcrumb structured data is generated from the same breadcrumb array used by visible navigation to prevent divergence.
- Menu instances reuse the existing OpenCart Layout module contract instead of introducing a parallel extension type.

## [1.2.0] - 2026-08-25

### Български

#### Добавено
- Препоръчани OpenCart продукти към всяка услуга.
- Autocomplete избор на продукти в администрацията на услугата.
- Индивидуална подредба на препоръчаните продукти.
- Публично показване на препоръчаните продукти с изображение, описание, цена, специална цена, данък и рейтинг според стандартната OpenCart продуктова логика.
- Нова таблица `probg_service_product` за връзката услуга ↔ продукт.
- Category Layout Override по магазин, реализиран по архитектурния модел на ProBG Blog.
- Нова таблица `probg_service_category_to_layout`.
- Избор на OpenCart Layout за всяка категория и всеки магазин от администрацията.
- Наследяване на Layout Override от услугите в съответната категория.
- Нов reusable модул **ProBG Services Block** за стандартните OpenCart Layout позиции.
- Режим „Последни услуги“ за блока.
- Режим „Услуги от категория“ за блока.
- Режим „Избрани услуги“ за блока.
- Многоезично заглавие на всеки block instance.
- Настройки за лимит и размери на изображенията за всеки block instance.
- Автоматично безопасно schema upgrade поведение чрез `ensureSchema()` за съществуващи инсталации.
- Автоматично добавяне на права за новия `extension/module/probg_services_block` route.

#### Променено
- Версията на модула е увеличена до `1.2.0` като backward-compatible feature release.
- Етапът на разработка е преместен на Етап 7.
- Публичният catalog model вече поддържа explicit service ID selection и latest sort за reusable блоковете.
- Category и Service страниците прилагат category-specific `config_layout_id` преди зареждане на OpenCart layout колоните.

#### Архитектурни решения
- Препоръчаните продукти се пазят в отделна many-to-many таблица.
- Layout Override се пази по `(category_id, store_id)`.
- Новите таблици се създават idempotent при upgrade.

### English

#### Added
- Recommended OpenCart products for each service with autocomplete and explicit ordering.
- Public recommended-product cards.
- Per-store Category Layout Override and service inheritance.
- Reusable **ProBG Services Block** with Latest, Category and Featured modes.
- Multilingual headings and per-instance image/limit settings.
- Idempotent schema upgrades and module permissions.

#### Changed
- Version increased to `1.2.0`; development stage advanced to Stage 7.

#### Architecture decisions
- Recommended products use a dedicated many-to-many table.
- Layout Override is keyed by `(category_id, store_id)`.

## [1.1.0] - 2026-08-25

### Български

#### Добавено
- Назначаване на запитвания към администратор, филтри, вътрешни бележки и директни email отговори.
- История с `notify` маркер и устойчиво запазване при email грешка.

### English

#### Added
- Enquiry assignment, assignee filters, internal notes and direct customer email replies.
- Durable history with `notify` state when email delivery fails.

## [1.0.1] - 2026-08-25

### Български

#### Добавено
- Публични страници за услуги и категории, SEO URL, canonical/301, social metadata, structured data, sitemap, кеширане и database-first запитвания.

### English

#### Added
- Public service/category pages, SEO URLs, canonical/301 handling, social metadata, structured data, sitemap, caching and database-first enquiries.

## [0.3.2-dev] - 2026-08-14
### Added
- Administration menu aligned with ProBG Blog.

## [0.3.1-dev] - 2026-08-14
### Added
- Unified administration navigation and dashboard counters.

## [0.3.0-dev] - 2026-08-07
### Added
- Services CRUD, multilingual content, gallery, pricing, stores, related services and SEO URL management.

## [0.2.0-dev] - 2026-08-07
### Added
- Service-category administration with hierarchy, stores, metadata and SEO URLs.

## [0.1.0-dev] - 2026-08-06
### Added
- Initial OpenCart 3 extension structure, database foundation, permissions, languages, settings and documentation.
