<?php
namespace Webcore\Snitcher;

use Exception;
use Http\Client\Exception as HttpClientException;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\StreamFactory;
use Http\Message\UriFactory;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Webcore\Snitcher\Common\SnitcherRequestFactory;
use Webcore\Snitcher\Common\UserAgent;
use Webcore\Snitcher\Common\Version;
use Webcore\Snitcher\Params\Message;
use Webcore\Snitcher\Params\Token;

class Snitcher implements SnitcherInterface
{
    const URL = "https://nosnch.in/";

    /**
     * @var string
     */
    private $url;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * @var UriFactory
     */
    private $uriFactory;

    /**
     * Snitcher constructor.
     *
     * @param HttpClient $httpClient
     * @param MessageFactory $messageFactory
     * @param StreamFactory $streamFactory
     * @param UriFactory $uriFactory
     * @param string $url
     */
    public function __construct(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        StreamFactory $streamFactory,
        UriFactory $uriFactory,
        $url = self::URL
    ) {
        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->streamFactory = $streamFactory;
        $this->uriFactory = $uriFactory;
        $this->url = $url;
    }

    /**
     * @param string $token
     * @param string $message
     * @return string
     * @throws InvalidArgumentException
     * @throws HttpClientException
     * @throws Exception
     */
    public function snitch($token, $message = "")
    {
        $token = new Token($token);
        $message = new Message($message);
        $userAgent = (new UserAgent(Version::VERSION))->create();
        $requestFactory = new SnitcherRequestFactory($this->messageFactory, $this->streamFactory, $userAgent);
        $request = $requestFactory->createSnitcherRequest($this->createUriFromToken($token), $message);
        $response = $this->httpClient->sendRequest($request);
        $contents = $this->getContentsFromResponse($response);

        return $contents;
    }

    /**
     * @param Token $token
     * @return UriInterface
     */
    private function createUriFromToken(Token $token)
    {
        return $this->uriFactory->createUri($this->url.$token->getValue());
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function getContentsFromResponse(ResponseInterface $response)
    {
        $body = $response->getBody();
        $contents = $body->getContents();

        return $contents;
    }
}
