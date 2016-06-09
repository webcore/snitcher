<?php


namespace Webcore\Snitcher\Common;


use Http\Message\MessageFactory;
use Http\Message\StreamFactory;
use Psr\Http\Message\UriInterface;
use Webcore\Snitcher\Params\Message;

class SnitcherRequestFactory
{
    /**
     * @var MessageFactory
     */
    private $messageFactory;
    /**
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * RequestFactory constructor.
     *
     * @param MessageFactory $messageFactory
     * @param StreamFactory $streamFactory
     * @param string $userAgent
     */
    public function __construct(MessageFactory $messageFactory, StreamFactory $streamFactory, $userAgent)
    {
        $this->messageFactory = $messageFactory;
        $this->streamFactory = $streamFactory;
        $this->userAgent = $userAgent;
    }

    public function createSnitcherRequest(UriInterface $uri, Message $message)
    {
        $headers = $this->createHeaders($this->userAgent);
        $body = $this->createBody($message);
        $stream = $this->streamFactory->createStream($body);
        $request = $this->messageFactory->createRequest("POST", $uri, $headers, $stream);

        return $request;
    }

    /**
     * @param Message $message
     * @return string
     */
    private function createBody(Message $message)
    {
        $body = ["m" => $message->getValue()];

        return http_build_query($body);
    }

    /**
     * @param $userAgent
     * @return array
     */
    private function createHeaders($userAgent)
    {
        $headers = [
            "User-agent" => $userAgent,
            "Content-Type" => "application/x-www-form-urlencoded",
        ];

        return $headers;
    }
}
