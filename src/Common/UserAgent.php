<?php


namespace Webcore\Snitcher\Common;


/**
 * Snitcher ruby client user agent:
 * "Snitcher; #{engine}/#{RUBY_VERSION}; #{RUBY_PLATFORM}; v#{::Snitcher::VERSION}";
 *
 * Guzzle example:
 * Guzzle/4.0 curl/7.21.4 PHP/5.5.7
 *
 * Snitcher/0.1.0; PHP/7.0.6
 */
class UserAgent
{
    /**
     * @var string
     */
    private $engine;

    /**
     * @var string
     */
    private $engineVersion;

    /**
     * @var string
     */
    private $snitcherVersion;

    /**
     * UserAgent constructor.
     *
     * @param string $snitcherVersion
     */
    public function __construct($snitcherVersion)
    {
        $this->snitcherVersion = $snitcherVersion;
        if (defined('HHVM_VERSION')) {
            $this->engine = "HHVM";
            $this->engineVersion = HHVM_VERSION;
        } else {
            $this->engine = "PHP";
            $this->engineVersion = PHP_VERSION;
        }
    }


    public function create()
    {
        $userAgent = strtr(
            "Snitcher/%version%; %engine%/%engineVersion%",
            [
                "%version%" => $this->snitcherVersion,
                "%engine%" => $this->engine,
                "%engineVersion%" => $this->engineVersion,
            ]
        );

        return $userAgent;
    }
}
