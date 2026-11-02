# Choosing an API version

Logic4 publishes every API version as a separate OpenAPI document, and this client generates a separate namespace for each one. The namespace tells you which URL prefix a request class talks to.

| Namespace | Logic4 API | URL prefix | Still regenerated |
| --- | --- | --- | --- |
| `V10` | v1.0 | `/v1/` | No, frozen |
| `V11` | v1.1 | `/v1.1/` | No, frozen |
| `V12` | v1.2 | `/v1.2/` | No, frozen |
| `V13` | v1.3 | `/v1.3/` | No, frozen |
| `V14` | v1.4 | `/v1.4/` | No, frozen |
| `V20` | v2.0 | `/v2/` | No, frozen |
| `V30` | v3.0 | `/v3/` | Yes, daily |
| `V31` | v3.1 | `/v3.1/` | Yes, daily |

The same layout applies to the three namespaces that make up a version:

- `Requests\V11\*Request` holds one class per Logic4 tag (`Products`, `Orders`, `Stock` and so on) with one method per endpoint.
- `Responses\V11\*` holds the objects that endpoint methods return.
- `Data\V11\*` holds the objects nested inside responses, and in V10 to V20 also the records that paginated endpoints yield.

The [endpoint reference](endpoints/README.md) lists every class and method per namespace, with the HTTP route and return type.

## Which version to use

Use the highest version namespace that has the endpoint you need. Logic4 adds new endpoints to the newest version and marks older ones as deprecated. For a new integration that usually means `V30`, with `V31` for the few endpoints that only exist there. Endpoints that Logic4 never moved to v3 are only available in their original namespace.

Nothing stops you from mixing namespaces in one application. Each request class is independent, and they all share the same `ClientFactory` and access token.

## Namespace versus class suffix

Two different things carry a version number, and they do not always match:

- The namespace (`V11`) is the Logic4 API version of the endpoints in that class.
- A suffix on a class name (`ProductV11`, `ProductV14`) is part of Logic4's schema name and says which revision of the object you get back.

That is why `Data\V10\ProductV11`, `Data\V11\ProductV11` and `Data\V13\ProductV11` all exist: three API versions return the same product schema. Likewise `Requests\V30\ProductRequest::getProducts()` returns `ProductV14` objects. Always import the class from the namespace that matches the request class you are calling.

## Return shapes differ per version

The same method name can return a different shape in another namespace. `getProducts()` yields a `Generator` of products in V10 to V14 and returns a plain `array` in V30. Check the return type of the method you call rather than assuming. [Responses](responses.md) describes the three shapes.

## Deprecated endpoints

When Logic4 marks an endpoint as deprecated in its documentation, the generated method carries a `@deprecated` tag with Logic4's own text, for example:

```php
class ProductGroupsRequest extends Request
{
    /**
     * Verkrijg artikelgroepen o.b.v. het meegestuurde filter.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Artikelgroepen
     */
    public function getProductGroups(array $parameters = []): ProductGroupLogic4ResponseList
    {
        // ...
    }
}
```

IDEs strike these methods through and show Logic4's text, and [phpstan-deprecation-rules](https://github.com/phpstan/phpstan-deprecation-rules) reports every call to them. The endpoint reference marks them as `Deprecated` in its Status column.

## Frozen and regenerated namespaces

Since v4.0.0 the generator only regenerates major version 3. The constant `GENERATED_MAJOR_VERSION` in `generator/Generator.php` controls this. The daily "Update endpoints" workflow therefore only changes `V30` and `V31`; the older namespaces stay exactly as they were last generated. This keeps integrations on v1 and v2 stable while Logic4 continues to evolve v3.

Beta releases such as `4.1.0-beta.1` are generated from Logic4's QA environment and show what the next v3 revision will look like. See [CONTRIBUTING.md](../CONTRIBUTING.md) for how they are built.

## Where Logic4 documents its API

- Production: https://api.logic4server.nl/scalar/
- QA: https://qa.api.logic4server.nl/scalar/

Method descriptions in the generated classes and in the endpoint reference are copied from these pages, which is why they are in Dutch.
