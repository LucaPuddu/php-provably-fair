<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\ProvablyFair;
use PHPUnit\Framework\TestCase;

class ProvablyFairTest extends TestCase
{
    /** @var ProvablyFair */
    private $mock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = $this->getMockForAbstractClass(ProvablyFair::class);
    }

    /**
     * @test
     */
    public function itDefaultsToAlgorithmSha512256MinZeroAndMaxOneHundred()
    {
        $serverSeed = 'server seed';
        $clientSeed = 'server seed';
        $nonce = 'nonce';

        $this->mock->setServerSeed($serverSeed);
        $this->mock->setClientSeed($clientSeed);
        $this->mock->setNonce($nonce);

        $this->assertEquals('sha512/256', $this->mock->getAlgorithm());
        $this->assertEquals(0, $this->mock->getMin());
        $this->assertEquals(100, $this->mock->getMax());
    }
}
