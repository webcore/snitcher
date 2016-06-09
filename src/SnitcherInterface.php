<?php
namespace Webcore\Snitcher;

interface SnitcherInterface
{
    public function snitch($token, $message = "");
}
