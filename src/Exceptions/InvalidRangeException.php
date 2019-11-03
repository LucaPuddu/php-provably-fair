<?php

namespace PhpProvablyFair\Exceptions;

use Exception;

class InvalidRangeException extends Exception
{
    /**
     * InvalidRangeException constructor.
     * @param float $min
     * @param float $max
     */
    public function __construct(float $min, float $max)
    {
        parent::__construct("max cannot be smaller than min.\nMax: {$max}, min: {$min}");
    }
}
