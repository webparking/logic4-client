# Upgrade guide

Each section lists what changed between major versions and what to do about it. The [changelog](CHANGELOG.md) has the full list of releases.

## 3.x to 4.0

### PHP 8.3 or newer is required

4.0.0 drops support for PHP 8.1 and 8.2. Update `composer.json` in your application to `"php": "^8.3"` before upgrading.

### New `V30` namespace for Logic4 API v3

Logic4 API v3.0 is available as `Requests\V30`, `Responses\V30` and `Data\V30`. Nothing changes for code that uses `V10` to `V20`. When you move an integration to v3, note two differences:

- V3 methods return plain values instead of envelopes. A list is an `array`, a single object is that object, and there is no `validationMessages` property. See [Responses](docs/responses.md).
- Objects returned by V3 methods live in `Responses\V30`; objects nested inside them live in `Data\V30`.

### The generator only regenerates v3

The daily "Update endpoints" workflow now changes `V30` and `V31` only. `V10` to `V20` stay as they were last generated, so an upgrade within 4.x never changes their signatures.

### 4.0.1: enum properties in V30 are strings

4.0.0 generated some V30 enum properties as nested object classes, which made methods such as `getProductMedia()` fail with a `TypeError`. 4.0.1 types those properties as `string`. If you worked around this by catching the error, remove the workaround.

## 2.x to 3.0

### Every class moved into a version namespace

3.0.0 generates classes per Logic4 API version instead of once for all versions. The old flat namespaces are gone:

```php
use Webparking\Logic4Client\Data\Product;
use Webparking\Logic4Client\Requests\ProductRequest;
```

becomes

```php
use Webparking\Logic4Client\Data\V11\ProductV11;
use Webparking\Logic4Client\Requests\V11\ProductRequest;
```

To upgrade:

1. Replace every `Requests\*Request` import with the versioned namespace of the endpoints you call. The [endpoint reference](docs/endpoints/README.md) lists which namespace has which method.
2. Replace every `Data\*` and `Responses\*` import with the class from the same version. Class names may carry a suffix such as `ProductV11`; see [Choosing an API version](docs/api-versions.md).
3. Check return types. Some methods that returned an envelope now yield a `Generator` because the generator detects pagination from the request body.

### Removed endpoint in 3.0.5

`/v1/Webshop/AddWebshopUserProductToWebshopUserProductList` was removed by Logic4 and with it the V10 method. Use the v1.1 or v1.2 variant.

## 1.x to 2.0

No upgrade notes were recorded for this release. Compare the tags on GitHub if you still run 1.x: https://github.com/webparking/logic4-client/compare/v1.0.0...v2.0.0
