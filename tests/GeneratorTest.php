<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /** @var Generator */
    private $generator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generator = new Generator();
    }

    public function generationProvider()
    {
        return [
            ['sha512/256', 'serverseed', 'clientseed', 'nonce', 0, 100, 42],
            ['sha512/256', 'serverseed', 'clientseed', 'nonce', 0, 100, 42],
        ];
    }

    /**
     * @test
     * @dataProvider generationProvider
     * @param string $algorithm
     * @param string $serverSeed
     * @param string $clientSeed
     * @param string $nonce
     * @param float  $min
     * @param float  $max
     * @param float  $result
     * @throws InvalidAlgorithmException
     */
    public function itGeneratesACorrectOutput(
        string $algorithm,
        string $serverSeed,
        string $clientSeed,
        string $nonce,
        float $min,
        float $max,
        float $result
    ) {
        $this->generator->setAlgorithm($algorithm);
        $this->generator->setClientSeed($clientSeed);
        $this->generator->setServerSeed($serverSeed);
        $this->generator->setNonce($nonce);
        $this->generator->setMin($min);
        $this->generator->setMax($max);

        $this->assertEquals($result, $this->generator->generate());
    }
}
