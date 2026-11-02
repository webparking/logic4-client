# Errors

The client raises a small number of exception types. Which one you get depends on where the call failed.

| Situation | Exception |
| --- | --- |
| Logic4 answered with status 400 or higher | `Webparking\Logic4Client\Exceptions\Logic4ApiException` |
| Logic4 could not be reached, or the request timed out | A Guzzle exception such as `GuzzleHttp\Exception\ConnectException` |
| The identity server rejected the credentials | `GuzzleHttp\Exception\ClientException` with Guzzle's default settings, see below |
| The response body was not valid JSON | `JsonException` |
| A request was made while `ClientFactory::preventStrayRequests()` is on | `RuntimeException` |

`Logic4ApiException` extends `RuntimeException`, so a catch-all on `RuntimeException` covers both the API error and the stray request guard.

## API errors

`ClientFactory` adds a middleware that turns every response with status 400 or higher into a `Logic4ApiException`. The exception message and code come from Guzzle, and the original `GuzzleHttp\Exception\RequestException` is available through `getPrevious()`. Use it to read the full response body; Guzzle truncates the body in the message.

```php
use GuzzleHttp\Exception\RequestException;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;

try {
    $groups = $request->getProductGroups(['IsTopLevelGroup' => true]);
} catch (Logic4ApiException $exception) {
    $previous = $exception->getPrevious();

    if ($previous instanceof RequestException && null !== $previous->getResponse()) {
        $status = $previous->getResponse()->getStatusCode();
        $body = (string) $previous->getResponse()->getBody();
    }

    throw $exception;
}
```

`$exception->getCode()` holds the HTTP status code, which makes it easy to treat 4xx and 5xx differently.

## Token errors

`AccessTokenManager` posts to `https://idp.logic4server.nl/token` with its own Guzzle client. With Guzzle's default settings a rejected credential surfaces as `GuzzleHttp\Exception\ClientException` straight from that client. The manager's own check, which throws `Logic4ApiException` with the message `Could not get access token: ...`, only runs when the injected Guzzle client has `http_errors` disabled. Catch `GuzzleHttp\Exception\GuzzleException` as well if you want to handle authentication failures explicitly.

A token is cached for the `expires_in` seconds Logic4 reports. An expired or missing token is fetched again on the next request; there is no refresh token flow.

## Transport errors

The middleware only inspects responses. Connection failures, DNS errors and the 60 second timeout surface as Guzzle exceptions, usually `GuzzleHttp\Exception\ConnectException`. They implement `GuzzleHttp\Exception\GuzzleException`, which is the broadest interface to catch.

## Validation messages

Envelope responses in V10 to V20 carry a `validationMessages` array. Logic4 uses it for warnings about a request it did accept. They never raise an exception, so check the array when a write did not have the effect you expected:

```php
$response = $request->getProductGroupTypes();

foreach ($response->validationMessages as $message) {
    logger()->warning('Logic4: '.$message);
}
```

V30 and V31 responses do not carry validation messages. Logic4 reports problems there through the HTTP status instead.

## Retrying

The client does not retry on its own. Guzzle's retry middleware fits in through `ClientFactory::setHandlerStack()`. Middleware pushed before you hand the stack to the factory wraps the Logic4 middleware, so a failed response reaches your decider as a `Logic4ApiException`:

```php
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;

$stack = HandlerStack::create();
$stack->push(Middleware::retry(
    static fn (int $retries, RequestInterface $request, ?ResponseInterface $response, ?\Throwable $exception): bool => $retries < 3
        && $exception instanceof Logic4ApiException
        && $exception->getCode() >= 500,
));

$clientFactory = (new ClientFactory($tokenManager))->setHandlerStack($stack);
```

Set the handler stack before a request class makes its first call. A request class keeps the Guzzle client it built on first use.
