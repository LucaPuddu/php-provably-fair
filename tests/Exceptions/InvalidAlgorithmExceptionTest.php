<?php

namespace LucaPuddu\PhpProvablyFair\Tests\Exceptions;

use LucaPuddu\PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PHPUnit\Framework\TestCase;

class InvalidAlgorithmExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function messageIsCorrect()
    {
        $withNullAlgorithm = new InvalidAlgorithmException();
        $withAlgorithm = new InvalidAlgorithmException('sha512342');

        $this->assertEquals('Algorithm not provided.', $withNullAlgorithm->getMessage());
        $this->assertEquals("Algorithm sha512342 not supported.", $withAlgorithm->getMessage());
    }
}
