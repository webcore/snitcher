<?php
require_once __DIR__."/../vendor/autoload.php";

use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Http\Message\UriFactory\GuzzleUriFactory;
use Webcore\Snitcher\Snitcher;

try {
    $config = [
        "timeout" => 10,
        "proxy" => "tcp://localhost:8080",
    ];
    $httpClient = new Client(new GuzzleHttp\Client($config));
    $messageFactory = new GuzzleMessageFactory();
    $streamFactory = new GuzzleStreamFactory();
    $uriFactory = new GuzzleUriFactory();
    $snitcher = new Snitcher($httpClient, $messageFactory, $streamFactory, $uriFactory);
    $response = $snitcher->snitch("c2354d53d2", "Finished in 26.76 seconds.");
    echo $response; //Got it, thanks!
} catch (Exception $e) {
    echo $e->getMessage();
}
