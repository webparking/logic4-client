# Changelog

All notable changes to this package are documented here. The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and the package follows [Semantic Versioning](https://semver.org/). Entries before this file existed were reconstructed from the GitHub releases.

## [Unreleased]

### Added

- `V31` namespace for Logic4 API v3.1 (#78).
- `docs/` with guides for getting started, API versions, responses, errors, configuration and testing.
- `docs/endpoints/`, a generated reference of every request class and method per API version, produced by `composer generate-endpoint-docs` and verified in CI by `composer check-endpoint-docs`.
- `CHANGELOG.md`, `UPGRADE.md`, `CONTRIBUTING.md`, `SECURITY.md` and GitHub issue templates.
- A test that parses every PHP snippet in the documentation, so a broken example fails the build.

### Changed

- README rewritten around the versioned namespaces; the previous examples imported classes that no longer exist.
- Composer description and keywords aligned with the GitHub description.

## [4.1.0-beta.1] - 2026-11-02

Prerelease generated from Logic4 QA build `257.999.0.64803`.

## [4.0.1] - 2026-06-22

### Fixed

- V3 enum-typed DTO properties were generated as nested object classes instead of strings, which made methods such as `getProductMedia()` fail with a `TypeError` (#76).

## [4.0.0] - 2026-06-16

### Added

- `V30` namespace for Logic4 API v3.0.

### Changed

- Requires PHP 8.3. Support for PHP 8.1 and 8.2 was dropped.
- The generator only regenerates major version 3; `V10` to `V20` are frozen.

### Fixed

- V30 endpoints that return a string decoded the raw body as JSON.

## [3.1.9] - 2026-04-09

### Changed

- Nullable types in generated classes follow the Logic4 schema more accurately (#70).
- `webmozart/assert` is declared as an explicit dependency (#69).
- Endpoints updated from the Logic4 documentation (#68).

## [3.1.8] - 2026-02-06

### Added

- Several new endpoints introduced by Logic4 (#64).

## [3.1.7] - 2025-09-25

### Fixed

- Memory leak in `ClientFactory` (#63).

## [3.1.6] - 2025-09-18

### Changed

- Endpoints updated from the Logic4 documentation (#61).

## [3.1.5] - 2025-08-13

### Changed

- Carbon 3.8 and newer are allowed.
- The products endpoint no longer returns null data; the package already handled this.

## [3.1.4] - 2025-06-23

### Added

- New endpoint and data models (#57).

### Fixed

- The cached access token could disappear between the `has` and `get` calls (#58).

## [3.1.3] - 2025-05-13

### Added

- Support for array responses with a schema (#56).

### Changed

- Endpoints updated from the Logic4 documentation (#55).

## [3.1.2] - 2025-05-02

### Added

- New endpoints introduced by Logic4 (#53).

### Deprecated

- `DeliveryRequest::createDeliveryForOrderRows()` in `V10`.
- `FinancialRequest::addFinancialBookingWithMutations()` in `V10`.

## [3.1.1] - 2025-03-27

### Fixed

- Access token cache key uniqueness when switching administrations (#52).
- PHPStan error on `/v1.1/Products/GetBarcodeTypes`.

## [3.1.0] - 2025-02-19

### Added

- `/v1.2/Products/GetBarcodeTypes`.

### Changed

- `/v1.1/Products/GetBarcodeTypes` returns an array and is deprecated.
- `/v1/Email/GetEmailMessages` and `/v1/BuyOrderDeliveries/GetBuyOrderDeliveries` return a generator.

### Fixed

- Invalid response schema for `CreateBuyOrder` (#47).

## [3.0.9] - 2025-02-11

### Changed

- Endpoints updated from the Logic4 documentation (#50).

## [3.0.8] - 2025-01-17

### Changed

- Request body documentation includes the nullable state of each property (#49).

## [3.0.7] - 2025-01-15

### Changed

- Endpoints updated from the Logic4 documentation (#48).

## [3.0.6] - 2024-12-03

### Changed

- The access token cache key includes the client identity (#46).
- Endpoints updated from the Logic4 documentation (#45).

### Removed

- Response models that Logic4 deleted (#43).

## [3.0.5] - 2024-10-31

### Changed

- Endpoints updated from the Logic4 documentation (#42).

### Removed

- `/v1/Webshop/AddWebshopUserProductToWebshopUserProductList`; use v1.1 or v1.2 instead.
- Leftover `WebshopUserProductLogic4ResponseList` (#44).

## [3.0.4] - 2024-09-06

### Fixed

- Generator fixes (#39).

### Changed

- Endpoints updated from the Logic4 documentation (#38).

## [3.0.3] - 2024-08-12

### Changed

- Endpoints updated from the Logic4 documentation (#37).

## [3.0.2] - 2024-07-15

### Added

- DTOs generated for all API versions (#35).
- Documentation for stray request prevention (#34).

## [3.0.1] - 2024-07-01

### Fixed

- GitHub pipeline for automated endpoint updates (#32).

### Changed

- Endpoints updated from the Logic4 documentation (#33).

## [3.0.0] - 2024-06-25

### Changed

- Classes are generated per Logic4 API version in `V10`, `V11` and so on, which prevents collisions when Logic4 releases a new version of an existing endpoint. See [UPGRADE.md](UPGRADE.md).
- API versions are detected automatically from the Logic4 documentation page.

## [2.3.2] - 2025-10-03

Maintenance release on the 2.x branch.

## [2.3.1] - 2024-05-07

### Changed

- Endpoints updated from the Logic4 documentation (#29).

## [2.3.0] - 2024-04-29

### Added

- Pagination for endpoints with `Take` and `Skip` parameters (#28).

### Changed

- Endpoints updated from the Logic4 documentation (#27).

## [2.2.0] - 2024-04-18

### Fixed

- The generator ignored referenced method parameters (#26).

## [2.1.2] - 2024-02-02

### Changed

- Endpoints updated from the Logic4 documentation (#19).

## [2.1.1] - 2024-01-18

### Fixed

- Failing test after release (#18).

## [2.1.0] - 2024-01-18

### Added

- Invoice email and payment reminder email on customers (#17).
- Creating return orders (#17).
- Webshop visitor behaviour, such as last viewed articles and products in cart (#17).
- Type on `WebshopUserProductType` (#17).

### Changed

- Getting return orders is paginated and returns a generator (#17).

## [2.0.2] - 2024-01-10

No release notes were recorded.

## [2.0.1] - 2023-11-21

### Changed

- Nested array shapes in the PHPDoc of request parameters.

## [2.0.0] - 2023-11-06

No release notes were recorded.

## [1.0.0] - 2023-11-01

Initial release.

[Unreleased]: https://github.com/webparking/logic4-client/compare/v4.1.0-beta.1...HEAD
[4.1.0-beta.1]: https://github.com/webparking/logic4-client/releases/tag/v4.1.0-beta.1
[4.0.1]: https://github.com/webparking/logic4-client/compare/v4.0.0...v4.0.1
[4.0.0]: https://github.com/webparking/logic4-client/compare/v3.1.9...v4.0.0
[3.1.9]: https://github.com/webparking/logic4-client/compare/v3.1.8...v3.1.9
[3.1.8]: https://github.com/webparking/logic4-client/compare/v3.1.7...v3.1.8
[3.1.7]: https://github.com/webparking/logic4-client/compare/v3.1.6...v3.1.7
[3.1.6]: https://github.com/webparking/logic4-client/compare/v3.1.5...v3.1.6
[3.1.5]: https://github.com/webparking/logic4-client/compare/v3.1.4...v3.1.5
[3.1.4]: https://github.com/webparking/logic4-client/compare/v3.1.3...v3.1.4
[3.1.3]: https://github.com/webparking/logic4-client/compare/v3.1.2...v3.1.3
[3.1.2]: https://github.com/webparking/logic4-client/compare/v3.1.1...v3.1.2
[3.1.1]: https://github.com/webparking/logic4-client/compare/v3.1.0...v3.1.1
[3.1.0]: https://github.com/webparking/logic4-client/compare/v3.0.9...v3.1.0
[3.0.9]: https://github.com/webparking/logic4-client/compare/v3.0.8...v3.0.9
[3.0.8]: https://github.com/webparking/logic4-client/compare/v3.0.7...v3.0.8
[3.0.7]: https://github.com/webparking/logic4-client/compare/v3.0.6...v3.0.7
[3.0.6]: https://github.com/webparking/logic4-client/compare/v3.0.5...v3.0.6
[3.0.5]: https://github.com/webparking/logic4-client/compare/v3.0.4...v3.0.5
[3.0.4]: https://github.com/webparking/logic4-client/compare/v3.0.3...v3.0.4
[3.0.3]: https://github.com/webparking/logic4-client/compare/v3.0.2...v3.0.3
[3.0.2]: https://github.com/webparking/logic4-client/compare/v3.0.1...v3.0.2
[3.0.1]: https://github.com/webparking/logic4-client/compare/v3.0.0...v3.0.1
[3.0.0]: https://github.com/webparking/logic4-client/compare/v2.3.1...v3.0.0
[2.3.2]: https://github.com/webparking/logic4-client/compare/v2.3.1...v2.3.2
[2.3.1]: https://github.com/webparking/logic4-client/compare/v2.3.0...v2.3.1
[2.3.0]: https://github.com/webparking/logic4-client/compare/v2.2.0...v2.3.0
[2.2.0]: https://github.com/webparking/logic4-client/compare/v2.1.2...v2.2.0
[2.1.2]: https://github.com/webparking/logic4-client/compare/v2.1.1...v2.1.2
[2.1.1]: https://github.com/webparking/logic4-client/compare/v2.1.0...v2.1.1
[2.1.0]: https://github.com/webparking/logic4-client/compare/v2.0.2...v2.1.0
[2.0.2]: https://github.com/webparking/logic4-client/compare/v2.0.1...v2.0.2
[2.0.1]: https://github.com/webparking/logic4-client/compare/v2.0.0...v2.0.1
[2.0.0]: https://github.com/webparking/logic4-client/compare/v1.0.0...v2.0.0
[1.0.0]: https://github.com/webparking/logic4-client/releases/tag/v1.0.0
