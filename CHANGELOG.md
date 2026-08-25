# Changelog

All notable changes to ProBG Services are documented in this file.

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
- README, архитектурната документация, database документацията и development plan са обновени за новия merchandising/layout слой.

#### Архитектурни решения
- Препоръчаните продукти се пазят в отделна many-to-many таблица, а не като сериализирана настройка в услугата.
- Layout Override се пази по `(category_id, store_id)`, което запазва multi-store семантиката на OpenCart и следва модела на ProBG Blog.
- Липсващ/нулев Layout Override оставя стандартната OpenCart route layout резолюция непроменена.
- Новите таблици се създават idempotent при отваряне на **Услуги → Настройки**, така че upgrade от `1.1.0` не изисква деинсталиране и не губи данни.

### English

#### Added
- Recommended OpenCart products for each service.
- Product autocomplete in service administration.
- Explicit sort order for recommended products.
- Public recommended-product cards with image, description, price, special price, tax and rating using standard OpenCart product semantics.
- New `probg_service_product` service-to-product relation table.
- Per-store Category Layout Override following the ProBG Blog architecture.
- New `probg_service_category_to_layout` table.
- OpenCart Layout selection for each service category and store.
- Service pages inherit the Layout Override of their owning category.
- New reusable **ProBG Services Block** module for standard OpenCart Layout positions.
- Latest services block mode.
- Category-filtered services block mode.
- Featured/selected services block mode.
- Multilingual heading per block instance.
- Per-instance limit and image-dimension settings.
- Idempotent `ensureSchema()` upgrade behavior for existing installations.
- Automatic permissions for the new `extension/module/probg_services_block` route.

#### Changed
- Module version increased to `1.2.0` as a backward-compatible feature release.
- Development stage advanced to Stage 7.
- Storefront catalogue model now supports explicit service-ID selection and latest sorting for reusable blocks.
- Category and Service pages apply category-specific `config_layout_id` before OpenCart layout columns are rendered.
- README, architecture documentation, database documentation and development plan updated for the merchandising/layout layer.

#### Architecture decisions
- Recommended products use a dedicated many-to-many table instead of serialized service settings.
- Layout Override is keyed by `(category_id, store_id)`, preserving OpenCart multi-store semantics and matching the ProBG Blog pattern.
- Missing/zero Layout Override leaves standard OpenCart route layout resolution unchanged.
- New tables are created idempotently when **Services → Settings** is opened, allowing upgrade from `1.1.0` without uninstalling or deleting data.

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
- Йерархични SEO route ключове `probg_service_category_id` и `probg_service_id`.
- Canonical URL и HTTP 301 корекция при заявена услуга през грешна категория.
- Open Graph и Twitter Card метаданни.
- JSON-LD `CollectionPage`, `Service`, `Offer` и `Organization`.
- Самостоятелен Services sitemap endpoint и интеграция със стандартния OpenCart Google Sitemap.
- Публична форма за запитване към всяка услуга.
- Database-first записване на запитванията, файлове, CAPTCHA/honeypot защита и отделна административна секция **Запитвания**.

#### Променено
- Публичната архитектура е уеднаквена с доказания модел на ProBG Blog, но със service-domain семантика.
- Административната навигация включва **Настройки / Категории / Услуги / Запитвания**.

#### Сигурност
- Файловете от запитванията се записват в `DIR_STORAGE/upload/` със случайно генерирани имена.
- Изпълними/script разширения не се приемат.

### English

#### Added
- Public Services landing, category and individual service pages following the ProBG Blog architecture.
- Store/language-aware catalogue model and cache.
- Hierarchical SEO URLs, canonical URLs and 301 correction.
- Open Graph, Twitter Cards and JSON-LD `CollectionPage`, `Service`, `Offer` and `Organization`.
- Dedicated Services sitemap and standard Google Sitemap integration.
- Public per-service enquiry forms with database-first persistence, attachments, CAPTCHA/honeypot protection and dedicated Enquiries administration.

#### Changed
- Storefront architecture aligned with ProBG Blog while preserving service-domain semantics.
- Administration navigation includes **Settings / Categories / Services / Enquiries**.

#### Security
- Enquiry files use random storage filenames under `DIR_STORAGE/upload/`.
- Executable/script extensions are rejected.

## [0.3.2-dev] - 2026-08-14

### Added
- Administration root menu follows the ProBG Blog pattern with localized labels and per-route permissions.

## [0.3.1-dev] - 2026-08-14

### Added
- Unified Settings / Categories / Services administration navigation and dashboard counters.

## [0.3.0-dev] - 2026-08-07

### Added
- Full services administration CRUD, multilingual content, gallery, pricing, stores, related services and SEO URL management.

## [0.2.0-dev] - 2026-08-07

### Added
- Full service-category administration with hierarchy, stores, metadata and SEO URLs.

## [0.1.0-dev] - 2026-08-06

### Added
- Initial OpenCart 3 extension structure, database foundation, permissions, languages, settings and documentation.

### Design decisions
- Uninstall preserves business data.
- OpenCart 3 and OpenCart 4 use separate packages.
- Enquiries are stored independently of email delivery status.
