<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;
use PhpProvablyFair\Verifier;
use PHPUnit\Framework\TestCase;

class VerifierTest extends TestCase
{
    /** @var Verifier */
    private $verifier;

    protected function setUp(): void
    {
        parent::setUp();
        $this->verifier = new Verifier();
    }

    public function verificationProvider()
    {
        return [
            ['sha512/256', 'serverseed', 'clientseed', 'nonce', 0, 100, 42],
            ['sha512/256', 'serverseed', 'clientseed', 'nonce', 0, 100, 42]
        ];
    }

    /**
     * @test
     * @dataProvider verificationProvider
     * @param string $algorithm
     * @param string $serverSeed
     * @param string $clientSeed
     * @param string $nonce
     * @param float  $min
     * @param float  $max
     * @param float  $result
     * @throws InvalidAlgorithmException
     * @throws InvalidRangeException
     */
    public function itVerifiesCorrectly(
        string $algorithm,
        string $serverSeed,
        string $clientSeed,
        string $nonce,
        float $min,
        float $max,
        float $result
    ) {
        $this->verifier->setAlgorithm($algorithm);
        $this->verifier->setClientSeed($clientSeed);
        $this->verifier->setServerSeed($serverSeed);
        $this->verifier->setNonce($nonce);
        $this->verifier->setRange($min, $max);

        $this->assertTrue($this->verifier->verify($result));
        $this->assertFalse($this->verifier->verify('incorrect'));
    }
}
