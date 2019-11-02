<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Interfaces\ProvablyFairInterface;
use PhpProvablyFair\Traits\ProvablyFairTrait;

abstract class ProvablyFair implements ProvablyFairInterface
{
    use ProvablyFairTrait;

    public function __construct()
    {
        $this->algorithm = self::DEFAULT_ALGORITHM;
        $this->min = self::DEFAULT_MIN;
        $this->max = self::DEFAULT_MAX;
    }
}
