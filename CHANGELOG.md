# Cortex Foundation Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v5.0.2] - 2020-06-21
- Tweak subdomain route parameter binding

## [v5.0.1] - 2020-06-19
- Fix request.guard binding issue when running in console

## [v5.0.0] - 2020-06-19
- Update composer dependencies
- Introducing module early bootstrapping feature
- Override core Application foundation class and PackageManifest bootstrap cache builder
- Override LarouteCollection to fix issues with cached routes
- Refactor route parameters to container service binding
- Rename ForgetLocaleRouteParameter to UnbindRouteParameters and change execution order - Plus unbind {subdomain} route parameter
- Refactor route parameters to container service binding
- Rename SetAccessArea Middleware to DiscoverNavigationRoutes
- Merge event discovery into DiscoveryServiceProvider
- Stick to composer version constraints recommendations and ease minimum required version of modules

## [v4.2.0] - 2020-06-15
- Autoload config, views, language, menus, breadcrumbs, and migrations for all modules
- Add intl-tel-input images to webpack processing
- Drop using rinvex/laravel-cacheable from core packages for more flexibility
  - Caching should be handled on the application layer, not enforced from the core packages
- Drop PHP 7.2 & 7.3 support from travis
- Tweak selected_ids collection filtration and check

## [v4.1.1] - 2020-05-30
- Update composer dependencies

## [v4.1.0] - 2020-05-30
- With the significance of recent updates, new minor release required

## [v4.0.9] - 2020-05-30
- Disable datatables button fade effect
- Update datatables query method
- Remove useless datatables checkbox config option
- Add datatables checkbox column for bulk actions
- Always use parent::query() when overriding datatables query() methods
- Drop using strip_tags on redirect identifiers as they will use ->getRouteKey() which is already safe
- Auto close bulk menu after child actions are clicked
- Move datatable buttons creation to separate method
- Add missing phrases for datatables bulk actions
- Add support for datatables to render bulk delete, activate, and deactivate actions implictly
- Reorder datatables buttons
- Add support for customizing pageLength and lengthMenu datatables options
- Convert datatables to work completely in POST ajax requests instead of GET requests for better security and to overcome long query strings / requests parameters and add support for datatable filter forms
- Add missing phrases for datatables bulk actions
- Add support for customizing pageLength and lengthMenu datatables options
- Rename selectedIds variables for consistency
- Refactor model CRUD dispatched events
- Refactor datatables default options and serverside buttons and support selected rows
- Move broadcasting authentication route to cortex/auth module
- Fire custom model events from CRUD actions
- Explicitly specify relationship attributes
- Load module routes automatically
- Revert back breadcrumbs escaping, this is handled individually as we may pass HTML intentionally
- Strip tags of language phrase parameters with potential user inputs
- Escape breadcrumb titles
- Escape language phrases
- Update model validation rules
- Add strip_tags validation rule to string fields
- Remove default indent size config

## [v4.0.8] - 2020-04-12
- Fix ServiceProvider registerCommands method compatibility

## [v4.0.7] - 2020-04-09
- Tweak artisan command registration
- Refactor publish command and allow multiple resource values

## [v4.0.6] - 2020-04-07
- Fix wrong module webpack config file name

## [v4.0.5] - 2020-04-04
- Enforce consistent artisan command tag namespacing
- Enforce consistent package namespace
- Drop laravel/helpers usage as it's no longer used
- Upgrade silber/bouncer composer package

## [v4.0.4] - 2020-03-20
- Add shortcut -f (force) for artisan publish commands
- Fix migrations path condition
- Convert database int fields into bigInteger
- Upgrade spatie/laravel-medialibrary to v8.x
- Fix couple issues and enforce consistency

## [v4.0.3] - 2020-03-16
- Update compatibility with Laravel v7.x

## [v4.0.2] - 2020-03-15
- Fix incompatible package version league/fractal

## [v4.0.1] - 2020-03-15
- Fix wrong package version laravelcollective/html

## [v4.0.0] - 2020-03-15
- Upgrade to Laravel v7.1.x & PHP v7.4.x

## [v3.1.4] - 2020-03-13
- Install felixkiss/uniquewith-validator composer package

## [v3.1.3] - 2020-03-13
- Tweak TravisCI config
- Fix production artisan commands registration	764d9ee	Abdelrahman Omran <me@omranic.com>	Jan 16, 2020 at 9:39 AM
- Add migrations autoload option to the package
- Tweak service provider `publishesResources` & `autoloadMigrations`
- Update composer dependencies
- Update tenant name in tenantarea
- Update meta tags for tenant in tenantarea
- Update StyleCI config
- Drop using global helpers
- Check if ability exists before seeding

## [v3.1.2] - 2019-12-18
- Fix `migrate:reset` args as it doesn't accept --step
- Fix Crawling Robots indexable access areas check (#97)
  - fix should index checker by check if access area listed in cortex.foundation.route.prefix 
  - Fix Crawling Robots indexable access areas check 
- Auto discover events listeners and register events automatically

## [v3.1.1] - 2019-12-04
- Add ajax filters capabilities to datatables
- Tweak obscure feature
- Add id attribute to the main div content in body
- Fix file size validation rule

## [v3.1.0] - 2019-11-23
- Fix Crawling Robots indexable access areas feature
- Rename AccessArea Middleware to SetAccessArea
- Arrange SetAccessArea & Reauthenticate middleware priorities order
- Update error views
- Override ThrottleRequests middleware
- Handle ThrottleRequestsException
- Remember current URL for later redirect, when unauthenticated exception handled

## [v3.0.3] - 2019-10-14
- Update menus & breadcrumbs event listener to accessarea.ready
- Fix wrong dependencies letter case
- Fix & tweak event dispatcher for menus & breadcrumbs to use middleware instead of AbstractController
- Update middleware priority
- Remove unused overridden middleware to reduce confusion
- Fix guard names singular / plural

## [v3.0.2] - 2019-10-06
- Refactor menus and breadcrumb bindings to utilize event dispatcher
- Fix compatibility with Laravel v6
- Utilize cortex.foundation.route.trailing_slash config option correctly
- Refactor MigrationServiceProvider
- Enforce consistency
- Fix and optimize Laravel JS Localization binding

## [v3.0.1] - 2019-09-24
- Add missing laravel/helpers composer package

## [v3.0.0] - 2019-09-23
- Upgrade to Laravel v6 and update dependencies

## [v2.2.5] - 2019-09-03
- Fix size validation rule

## [v2.2.4] - 2019-09-03
- Fix issue with: Update HttpKernel to use Authenticate middleware under App namespace

## [v2.2.3] - 2019-09-03
- Conditionally inject Clockwork middleware to web group if not on production environment

## [v2.2.2] - 2019-09-03
- Enforce profile_picture and cover_photo image validation rules & update media config
- Update media config options
- use set function instead of header as BinaryFileResponse doesn't have header funcation (#90)
- Use $_SERVER instead of $_ENV for PHPUnit
- Move TrustProxies to highest priority - fixes maintenance mode ip whitelist if behind proxy e.g. Cloudflare (https://github.com/laravel/laravel/pull/5055)
- Update HttpKernel to use Authenticate middleware under App namespace

## [v2.2.1] - 2019-08-03
- Tweak menus & breadcrumbs performance

## [v2.2.0] - 2019-08-03
- Upgrade composer dependencies
- Rename datatable views
- Disable default AuthenticateSession middleware
- Use singular guard name instead of plural

## [v2.1.3] - 2019-06-03
- Enforce latest composer package versions

## [v2.1.2] - 2019-06-03
- Update publish commands to support both packages and modules natively

## [v2.1.1] - 2019-06-02
- Fix yajra/laravel-datatables-fractal and league/fractal compatibility

## [v2.1.0] - 2019-06-02
- Update composer deps
- Drop PHP 7.1 travis test
- Override Laroute & JSLocalization artisan commands
- Update edvinaskrucas/notification to dev-master to fix Laravel 5.8 compatibility issues (not tagged yet)
- Refactor migrations and artisan commands, and tweak service provider publishes functionality

## [v2.0.3] - 2019-03-04
- Fix exception handler method signature compatibility issue

## [v2.0.2] - 2019-03-04
- Revert "Move lord/laroute composer dependency to project level"

## [v2.0.1] - 2019-03-04
- Move lord/laroute composer dependency to project level

## [v2.0.0] - 2019-03-03
- Require PHP 7.2 & Laravel 5.8
- Activate AuthenticateSession middleware
- Utilize support helpers
- Fix json/array casting type
- Refactor abilities seeding
- Refactor managed roles/abilities retrieval
- Drop duplicate useless overridden method

## [v1.0.4] - 2019-01-03
- Fix MySQL / PostgreSQL json column compatibility
- Update spatie/laravel-activitylog functionality
- Rename environment variable QUEUE_DRIVER to QUEUE_CONNECTION

## [v1.0.3] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis
- Add signed and verified middleware
- Simplify and flatten resources/public directories
- Simplify $route->getAction() usage
- Simplify controller actions
  - Move area roles & abilities retrieval to global helper
- Fix favicon paths
- Remove useless AuthenticateWithBasicAuth override (Laravel v5.7)

## [v1.0.2] - 2018-10-25
- Correct commit "Stop ignoring file on export, we need it in new module generation"

## [v1.0.1] - 2018-10-25
- Stop ignoring file on export, we need it in new module generation

## [v1.0.0] - 2018-10-01
- Support Laravel v5.7, bump versions and enforce consistency

## [v0.0.2] - 2018-09-22
- Too much changes to list here!!

## v0.0.1 - 2017-03-14
- Tag first release

[v5.0.2]: https://github.com/rinvex/cortex-foundation/compare/v5.0.1...v5.0.2
[v5.0.1]: https://github.com/rinvex/cortex-foundation/compare/v5.0.0...v5.0.1
[v5.0.0]: https://github.com/rinvex/cortex-foundation/compare/v4.2.0...v5.0.0
[v4.2.0]: https://github.com/rinvex/cortex-foundation/compare/v4.1.1...v4.2.0
[v4.1.1]: https://github.com/rinvex/cortex-foundation/compare/v4.1.0...v4.1.1
[v4.1.0]: https://github.com/rinvex/cortex-foundation/compare/v4.0.8...v4.1.0
[v4.0.9]: https://github.com/rinvex/cortex-foundation/compare/v4.0.8...v4.0.9
[v4.0.8]: https://github.com/rinvex/cortex-foundation/compare/v4.0.7...v4.0.8
[v4.0.7]: https://github.com/rinvex/cortex-foundation/compare/v4.0.6...v4.0.7
[v4.0.6]: https://github.com/rinvex/cortex-foundation/compare/v4.0.5...v4.0.6
[v4.0.5]: https://github.com/rinvex/cortex-foundation/compare/v4.0.4...v4.0.5
[v4.0.4]: https://github.com/rinvex/cortex-foundation/compare/v4.0.3...v4.0.4
[v4.0.3]: https://github.com/rinvex/cortex-foundation/compare/v4.0.2...v4.0.3
[v4.0.2]: https://github.com/rinvex/cortex-foundation/compare/v4.0.1...v4.0.2
[v4.0.1]: https://github.com/rinvex/cortex-foundation/compare/v4.0.0...v4.0.1
[v4.0.0]: https://github.com/rinvex/cortex-foundation/compare/v3.1.4...v4.0.0
[v3.1.4]: https://github.com/rinvex/cortex-foundation/compare/v3.1.3...v3.1.4
[v3.1.3]: https://github.com/rinvex/cortex-foundation/compare/v3.1.2...v3.1.3
[v3.1.2]: https://github.com/rinvex/cortex-foundation/compare/v3.1.1...v3.1.2
[v3.1.1]: https://github.com/rinvex/cortex-foundation/compare/v3.1.0...v3.1.1
[v3.1.0]: https://github.com/rinvex/cortex-foundation/compare/v3.0.3...v3.1.0
[v3.0.3]: https://github.com/rinvex/cortex-foundation/compare/v3.0.2...v3.0.3
[v3.0.2]: https://github.com/rinvex/cortex-foundation/compare/v3.0.1...v3.0.2
[v3.0.1]: https://github.com/rinvex/cortex-foundation/compare/v3.0.0...v3.0.1
[v3.0.0]: https://github.com/rinvex/cortex-foundation/compare/v2.2.5...v3.0.0
[v2.2.5]: https://github.com/rinvex/cortex-foundation/compare/v2.2.4...v2.2.5
[v2.2.4]: https://github.com/rinvex/cortex-foundation/compare/v2.2.3...v2.2.4
[v2.2.3]: https://github.com/rinvex/cortex-foundation/compare/v2.2.2...v2.2.3
[v2.2.2]: https://github.com/rinvex/cortex-foundation/compare/v2.2.1...v2.2.2
[v2.2.1]: https://github.com/rinvex/cortex-foundation/compare/v2.2.0...v2.2.1
[v2.2.0]: https://github.com/rinvex/cortex-foundation/compare/v2.1.2...v2.2.0
[v2.1.2]: https://github.com/rinvex/cortex-foundation/compare/v2.1.1...v2.1.2
[v2.1.1]: https://github.com/rinvex/cortex-foundation/compare/v2.1.0...v2.1.1
[v2.1.0]: https://github.com/rinvex/cortex-foundation/compare/v2.0.3...v2.1.0
[v2.0.3]: https://github.com/rinvex/cortex-foundation/compare/v2.0.2...v2.0.3
[v2.0.2]: https://github.com/rinvex/cortex-foundation/compare/v2.0.1...v2.0.2
[v2.0.1]: https://github.com/rinvex/cortex-foundation/compare/v2.0.0...v2.0.1
[v2.0.0]: https://github.com/rinvex/cortex-foundation/compare/v1.0.4...v2.0.0
[v1.0.4]: https://github.com/rinvex/cortex-foundation/compare/v1.0.3...v1.0.4
[v1.0.3]: https://github.com/rinvex/cortex-foundation/compare/v1.0.2...v1.0.3
[v1.0.2]: https://github.com/rinvex/cortex-foundation/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/rinvex/cortex-foundation/compare/v1.0.0...v1.0.1
[v1.0.0]: https://github.com/rinvex/cortex-foundation/compare/v0.0.2...v1.0.0
[v0.0.2]: https://github.com/rinvex/cortex-foundation/compare/v0.0.1...v0.0.2
