# Configuration

Three classes take constructor arguments. Everything else is generated and has no settings.

## `AccessTokenManager`

```php
new AccessTokenManager(
    cache: $cache,
    client: new GuzzleHttp\Client(),
    tokenUrl: 'https://idp.logic4server.nl/token',
);
```

| Argument | Type | Default | Purpose |
| --- | --- | --- | --- |
| `cache` | `Psr\SimpleCache\CacheInterface` | required | Stores the access token between requests and processes. |
| `client` | `GuzzleHttp\Client` | `new Client()` | Used only for the token request. Inject your own to add a proxy or to disable `http_errors`. |
| `tokenUrl` | `string` | `https://idp.logic4server.nl/token` | The OAuth token endpoint. |

### `configure()`

`configure()` takes one array with six required string keys:

| Key | Logic4 name |
| --- | --- |
| `public_key` | Public key |
| `company_key` | Company key |
| `username` | Username of the API user |
| `secret_key` | Secret key |
| `password` | Password of the API user |
| `administration_id` | Administration id |

Call `configure()` before the first request. Calling it again with other credentials switches administration; the cache key includes the credentials, so tokens never mix.

### Token cache

| Detail | Value |
| --- | --- |
| Cache key | `logic4:access_token:` followed by base64 of `client_id:scope` |
| `client_id` | `public_key company_key username`, with `_` in the username doubled and spaces replaced by `_` |
| Scope | `api administration.{administration_id}` |
| Grant | `client_credentials` |
| TTL | The `expires_in` value Logic4 returns, in seconds |

Because the key contains the client id and scope, one cache can safely hold tokens for several administrations.

## `ClientFactory`

```php
new ClientFactory(
    tokenManager: $tokenManager,
    options: [],
    baseUrl: 'https://api.logic4server.nl',
);
```

| Argument | Type | Default | Purpose |
| --- | --- | --- | --- |
| `tokenManager` | `AccessTokenManager` | required | Supplies the bearer token. |
| `options` | `array<string, mixed>` | `[]` | Guzzle client options merged into the client configuration, such as `headers`, `proxy` or `verify`. |
| `baseUrl` | `string` | `https://api.logic4server.nl` | Prefix for every endpoint path. |

Two settings are fixed and win over anything in `options`: the timeout is 60 seconds and the handler stack is the one described below.

```php
use Webparking\Logic4Client\ClientFactory;

$clientFactory = new ClientFactory($tokenManager, options: [
    'headers' => ['User-Agent' => 'my-app/1.0'],
    'proxy' => 'http://proxy.internal:3128',
]);
```

### Handler stack

`setHandlerStack()` replaces the Guzzle handler stack and pushes two middlewares onto it: one that adds the `Authorization: Bearer` header and one that turns status 400 and higher into `Logic4ApiException`. Push your own middleware onto the stack before passing it in. [Errors](errors.md) shows a retry middleware, [Testing](testing.md) shows Guzzle's `MockHandler`.

Call `setHandlerStack()` before a request class makes its first call. A request class keeps the client it built on first use.

### Stray requests

`ClientFactory::preventStrayRequests()` is a static switch for test suites. While it is on, every request built by any `ClientFactory` throws a `RuntimeException` before reaching the network. `ClientFactory::preventStrayRequests(false)` turns it off again.

## QA environment

Logic4 runs a QA environment with its own API host. Point the factory at it with `baseUrl`:

```php
use Webparking\Logic4Client\ClientFactory;

$clientFactory = new ClientFactory($tokenManager, baseUrl: 'https://qa.api.logic4server.nl');
```

Ask Logic4 which identity server and credentials belong to your QA administration. Beta releases of this package are generated from the QA documentation; see [Choosing an API version](api-versions.md).

## Request classes

Every request class extends `Webparking\Logic4Client\Request` and takes a `ClientFactory`. One method is relevant for configuration:

| Method | Purpose |
| --- | --- |
| `setClient(GuzzleHttp\Client $client)` | Replaces the Guzzle client for this request instance. Meant for tests; see [Testing](testing.md). |

## Laravel

The container resolves `AccessTokenManager` with your default cache store and a plain Guzzle client. To change the Guzzle options or base URL, bind `ClientFactory` yourself:

```php
use Illuminate\Support\ServiceProvider;
use Webparking\Logic4Client\AccessTokenManager;
use Webparking\Logic4Client\ClientFactory;

final class Logic4ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ClientFactory::class, static fn ($app): ClientFactory => new ClientFactory(
            $app->make(AccessTokenManager::class),
            options: ['headers' => ['User-Agent' => 'my-app/1.0']],
            baseUrl: config('services.logic4.base_url', 'https://api.logic4server.nl'),
        ));
    }
}
```

Register the credentials with `afterResolving()` as shown in [Getting started](getting-started.md).
