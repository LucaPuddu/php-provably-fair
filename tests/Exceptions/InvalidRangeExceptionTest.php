<?php

namespace PhpProvablyFair\Tests\Exceptions;

use PhpProvablyFair\Exceptions\InvalidRangeException;
use PHPUnit\Framework\TestCase;

class InvalidRangeExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function messageIsCorrect()
    {
        $min = 50;
        $max = 22;

        $e = new InvalidRangeException($min, $max);
        $this->assertEquals("max cannot be smaller than min.\nMax: {$max}, min: {$min}", $e->getMessage());
    }
}
