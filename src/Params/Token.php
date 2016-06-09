<?php


namespace Webcore\Snitcher\Params;


use Webcore\Validation\ValidationTrait;
use Webcore\Validation\ValidationValueBoxTrait;

class Token
{
    use ValidationTrait, ValidationValueBoxTrait;

    protected function validation($value)
    {
        $this->validateString($value);
        $this->validateHexadecimal($value);
        $this->validateLength($value, 10);
    }
}
