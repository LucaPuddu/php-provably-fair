<?php

namespace PhpProvablyFair\Tests\Traits;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;
use PhpProvablyFair\Traits\ProvablyFairTrait;
use PHPUnit\Framework\TestCase;

class ProvablyFairTraitTest extends TestCase
{
    /** @var ProvablyFairInterface */
    private $mock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = $this->getMockForTrait(ProvablyFairTrait::class);
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itAcceptsAValidHmacAlgorithm()
    {
        foreach (hash_hmac_algos() as $hash_hmac_algo) {
            $this->mock->setAlgorithm($hash_hmac_algo);
            $this->assertEquals($hash_hmac_algo, $this->mock->getAlgorithm());
        }
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itThrowsInvalidAlgorithmExceptionCorrectly()
    {
        $this->expectException(InvalidAlgorithmException::class);

        $this->mock->setAlgorithm('invalid hmac algorithm');
    }

    /**
     * @test
     * @throws InvalidRangeException
     */
    public function itThrowsInvalidRangeExceptionIfMinIsGreaterThanMax()
    {
        $this->expectException(InvalidRangeException::class);

        $this->mock->setRange(50, 22);
    }

    /**
     * @test
     * @throws InvalidRangeException
     */
    public function itThrowsInvalidRangeExceptionIfMinIsEqualToMax()
    {
        $this->expectException(InvalidRangeException::class);

        $this->mock->setRange(50, 50);
    }
}
