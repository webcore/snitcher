<?php


namespace Webcore\Snitcher\Params;


use Webcore\Validation\ValidationTrait;
use Webcore\Validation\ValidationValueBoxTrait;

/**
 * Only first 255 characters are received (rest is truncated)
 */
class Message
{
    use ValidationTrait, ValidationValueBoxTrait;

    protected function validation($value)
    {
        $this->validateString($value);
    }
}
