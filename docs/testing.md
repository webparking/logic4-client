# Testing your integration

Nothing in the client needs the network to be constructed, so your tests can stay offline. Pick the level at which you want to fake Logic4.

## Fake the Guzzle client of one request class

This is the pattern the package uses in its own tests. `Request::setClient()` swaps the Guzzle client, so you can assert the exact path and body that a method sends and feed it a canned JSON answer:

```php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\V10\OrderRequest;

$client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
    $mock->shouldReceive('get')
        ->once()
        ->with('/v1/Orders/GetOrderStatuses')
        ->andReturn(new Response(body: json_encode([
            'Records' => [['Id' => 12, 'Value' => 'Open']],
            'RecordsCounter' => 1,
            'ValidationMessages' => [],
        ], \JSON_THROW_ON_ERROR)));
});

$request = new OrderRequest(\Mockery::mock(ClientFactory::class));
$request->setClient($client);

$statuses = $request->getOrderStatuses();

// $statuses->records[0]->value === 'Open'
```

Paginated methods send `TakeRecords` and `SkipRecords` with every page. Expect `['json' => ['TakeRecords' => 1000, 'SkipRecords' => 0, ...]]` for the first page and answer with a `RecordsCounter` lower than the page size to end the iteration.

## Fake the request class itself

In application tests you usually care about what your code does with the data, not about the HTTP call. Mock the request class and return generated objects built with `make()`. Generator methods need a real `Generator`:

```php
use Mockery\MockInterface;
use Webparking\Logic4Client\Data\V11\ProductV11;
use Webparking\Logic4Client\Requests\V11\ProductRequest;

$this->mock(ProductRequest::class, static function (MockInterface $mock): void {
    $mock->shouldReceive('getProducts')
        ->with(['DebtorId' => 1])
        ->andReturnUsing(static function (): \Generator {
            yield ProductV11::make(['ProductId' => 1, 'ProductCode' => 'SKU-1']);
        });
});
```

Methods that return an envelope or a plain value can use `andReturn()` with an object built through its `make()` factory.

## Fake the HTTP layer with Guzzle's `MockHandler`

When you want the real request classes and the real middleware but no network, hand `ClientFactory` a handler stack built around `MockHandler`. The bearer middleware still asks `AccessTokenManager` for a token, so mock that too:

```php
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\AccessTokenManager;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\V30\UserRequest;

$tokenManager = \Mockery::mock(AccessTokenManager::class, static function (MockInterface $mock): void {
    $mock->shouldReceive('getAccessToken')->andReturn('test-token');
});

$handler = new MockHandler([
    new Response(200, [], 'Hello from Logic4'),
]);

$clientFactory = (new ClientFactory($tokenManager))->setHandlerStack(HandlerStack::create($handler));

$notice = (new UserRequest($clientFactory))->getNotice();

// $notice === 'Hello from Logic4'
// $handler->getLastRequest()->getHeaderLine('Authorization') === 'Bearer test-token'
```

Queue a `Response` with status 400 or higher to test your error handling; the middleware converts it into a `Logic4ApiException`.

## Guard against real requests

Turn on `ClientFactory::preventStrayRequests()` in your base test case. Any request that reaches the Guzzle handler stack then throws a `RuntimeException`, so a forgotten mock fails loudly instead of calling Logic4:

```php
use Webparking\Logic4Client\ClientFactory;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        ClientFactory::preventStrayRequests();
    }
}
```

The switch is static and stays on for the rest of the process. Call `ClientFactory::preventStrayRequests(false)` in a test that deliberately talks to Logic4.

## Building fixtures

Every generated object has a static `make(array $data)` factory that accepts the same keys Logic4 uses in its JSON. Missing keys fall back to `null`, `0`, `false` or an empty array, so a fixture only needs the fields your code reads.
