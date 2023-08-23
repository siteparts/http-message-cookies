# Cookies for PSR-7

*Add cookie headers to PSR-7 messages.*

## Installation

Via Composer:

```bash
$ composer require siteparts/http-message-cookies
```

## Usage

The `Set-Cookie` headers are added to the PSR-7 response object using the
`addTo` method of `ResponseCookie` class.

Set cookies using template:

```php
use DateTime;
use SiteParts\Cookies\HttpMessage\ResponseCookieTemplate;

$cookieTemplate = new ResponseCookieTemplate([
	'domain' => 'example.org',
	'path' => '/foo',
	'expires' => new DateTime("+14 days"),
]);

// $response is instance of Psr\Http\Message\ResponseInterface

$response = $cookieTemplate
	->create("lang", "en")
	->addTo($response);

$response = $cookieTemplate
	->create("color", "blue")
	->withSecure(true)
	->addTo($response);
```

Set cookies directly:

```php
use DateTime;
use SiteParts\Cookies\HttpMessage\ResponseCookie;

// $response is instance of Psr\Http\Message\ResponseInterface

$response = new ResponseCookie("lang", "en")
	->withDomain("example.org")
	->withPath("/foo")
	->withExpires(new DateTime("+14 days"))
	->addTo($response);

$response = new ResponseCookie("color", "blue")
	->withDomain("example.org")
	->withPath("/foo")
	->withExpires(new DateTime("+14 days"))
	->withSecure(true)
	->addTo($response);
```

Response cookie template parameters:

```php
$cookieTemplate = new ResponseCookieTemplate([
	'domain' => 'example.org',
	'path' => '/foo',
	'expires' => new DateTime("+14 days"),
	'max_age' => 14 * 24 * 60 * 60,
	'secure' => true,
	'http_only' => true,
	'same_site' => 'Strict',
]);
```

Response cookie methods:

```php
$cookie = new ResponseCookie("lang", "en")
	->withDomain("example.org")
	->withPath("/foo")
	->withExpires(new DateTime("+14 days"))
	->withMaxAge(14 * 24 * 60 * 60)
	->withSecure(true)
	->withHttpOnly(true)
	->withSameSite("Strict");
```

For use with a PSR-11 container, see `ResponseCookieTemplateFactory` class.
