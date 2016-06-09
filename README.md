# PHP Snitcher

Simple API client for [Dead Man's Snitch](https://deadmanssnitch.com) inspired by official [Ruby client](https://github.com/deadmanssnitch/snitcher)

[![Dependency Status](https://www.versioneye.com/user/projects/57595ef47757a00041b3b2ee/badge.svg?style=plastic)](https://www.versioneye.com/user/projects/57595ef47757a00041b3b2ee)
[![license](https://img.shields.io/github/license/webcore/snitcher.svg?maxAge=2592000)](https://opensource.org/licenses/MIT)

## Install

Via Composer

```
composer require webcore/snitcher
```

Snitcher depends on [HTTPlug](http://httplug.io/) HTTP client abstraction for PHP.
You can read more about [HTTPlug framework integration with Symfony bundle](http://docs.php-http.org/en/latest/integrations/symfony-bundle.html) in HTTPlug docs.

## Usage

### Example with Guzzle HTTP client

Install dependencies:
- Implementation of HttpClient adapter using Guzzle

    ```
    composer require php-http/guzzle6-adapter
    ```
- Implementations of MessageFactory, StreamFactory and UriFactory

    ```
    composer require php-http/message
    ```

Create required factories:

```php
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Http\Message\UriFactory\GuzzleUriFactory;

$httpClient = new Client(new GuzzleHttp\Client());
$messageFactory = new GuzzleMessageFactory();
$streamFactory = new GuzzleStreamFactory();
$uriFactory = new GuzzleUriFactory();
```

Create Snitcher instance:

```php
use Webcore\Snitcher\Snitcher;
$snitcher = new Snitcher($httpClient, $messageFactory, $streamFactory, $uriFactory);
```

To check in for one of your snitches:

```php
$snitcher->snitch("c2354d53d2");
```

You also may provide a message with the check in:

```php
$snitcher->snitch("c2354d53d2", "Finished in 23.8 seconds.")
```

If error occurs one of these exceptions is thrown:

```
InvalidArgumentException
HttpClientException
Exception
 ```
 
## Sample composer.json:

```
{
    "name": "some-user/nice-project",
    "require": {
        "webcore/snitcher": "^1.0.0",
        "php-http/guzzle6-adapter": "^1.1.1",
        "php-http/message": "^1.2.0"
    }
}
```

## TODO
- Client for [Dead Man's Snitch's JSON API](https://deadmanssnitch.com/docs/api/v1)
- Unit tests

### MIT license

Copyright (c) 2016, Štefan Peťovský
