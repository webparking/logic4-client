# Responses

Endpoint methods return one of three shapes. The return type of the method and its `@return` docblock tell you which one you get.

| Shape | Where | How to read it |
| --- | --- | --- |
| `\Generator<DTO>` | Paginated list endpoints in V10 to V20 | Iterate with `foreach`. Pages load while you iterate. |
| `*Logic4ResponseList` and other envelopes | Remaining endpoints in V10 to V20 | Read `->records`, `->recordsCounter` and `->validationMessages`. |
| `array`, `string`, `int`, `bool`, `void` or a single object | V30 and V31 | Plain PHP values. |

## Generators: paginated lists

Endpoints whose request body has `TakeRecords` and `SkipRecords` (or `Take` and `Skip`) and whose response has `Records` and `RecordsCounter` are generated as paginating methods. They return a `Generator` that yields one object per record:

```php
use Webparking\Logic4Client\Requests\V11\ProductRequest;

$products = new ProductRequest($clientFactory);

foreach ($products->getProducts(['DebtorId' => 1]) as $product) {
    echo $product->productId, \PHP_EOL;
}
```

How pagination works:

- Nothing is requested until you start iterating.
- The first request asks for 1000 records starting at 0. Every following request moves `SkipRecords` forward by the page size.
- Iteration stops after the first page that holds fewer records than the page size.
- Pass your own `TakeRecords` (or `Take`) to change the page size. The value you pass wins over the default of 1000.
- A generator can only be iterated once. Call the method again for a second pass.
- `iterator_to_array()` loads every page into memory before returning. For large sets, process records inside the `foreach` instead.

The `@return` docblock names the object you get, for example `\Generator<array-key, ProductV11>`. In V10 to V20 these record objects live in the `Data` namespace of the same version.

## Envelopes: `*Logic4ResponseList`

Endpoints in V10 to V20 that return a list without pagination return an envelope object with three public properties:

```php
use Webparking\Logic4Client\Requests\V10\ProductGroupsRequest;

$response = (new ProductGroupsRequest($clientFactory))->getProductGroupTypes();

$response->records;            // array of Data\V10\ProductGroupType
$response->recordsCounter;     // int, the number of records Logic4 reports
$response->validationMessages; // array of strings from Logic4
```

Single values use the same pattern. `BooleanLogic4Response`, for example, carries `->value` and `->validationMessages`. Validation messages are informational: Logic4 accepted the request but wants to tell you something about it. They never cause an exception. See [Errors](errors.md).

## Plain values: V30 and V31

Logic4 dropped the envelope in API v3. Methods in `V30` and `V31` return exactly what the endpoint returns:

- A list becomes an `array` of objects, documented as `@return array<array-key, ProductV14>`.
- A single object becomes that object, for example `Responses\V30\ProductV14`.
- Scalars become `string`, `int` or `bool`.
- Endpoints without a response body are `void`.

```php
use Webparking\Logic4Client\Requests\V30\ProductRequest;

$products = (new ProductRequest($clientFactory))->getProducts(['DebtorId' => 1]);

foreach ($products as $product) {
    echo $product->productCode, \PHP_EOL;
}
```

Objects returned by V30 methods live in `Responses\V30`. Objects nested inside them, such as `ProductShiftPriceV14` inside `ProductV14`, live in `Data\V30`.

## Response objects

Every generated object follows the same rules:

- Properties are public and named in camelCase after the Logic4 field (`ProductCode` becomes `productCode`).
- Properties that Logic4 marks nullable are nullable in PHP.
- Date and time fields are `Carbon\Carbon` instances.
- Enum fields are plain strings with Logic4's enum values.
- Nested objects are instances of the matching generated class; lists of them are arrays.
- Each class has a static `make(array $data)` factory that builds it from a decoded JSON array. You can use it in tests to build fixtures.

```php
use Webparking\Logic4Client\Data\V11\ProductV11;

$product = ProductV11::make([
    'ProductId' => 1,
    'ProductCode' => 'SKU-1',
]);
```

Keys you leave out fall back to `null`, `0`, `false` or an empty array depending on the type.
