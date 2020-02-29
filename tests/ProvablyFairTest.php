<?php

namespace PhpProvablyFair\Tests;

use LucaPuddu\PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use LucaPuddu\PhpProvablyFair\Exceptions\InvalidRangeException;
use LucaPuddu\PhpProvablyFair\ProvablyFair;
use PHPUnit\Framework\TestCase;

class ProvablyFairTest extends TestCase
{
    /** @var ProvablyFair */
    private $provablyFair;

    protected function setUp(): void
    {
        parent::setUp();
        $this->provablyFair = new ProvablyFair();
    }

    public function dataProvider()
    {
        return [
            ['sha512/256', 'server seed', 'client seed', '1', 90, 100, 97.50919006089],
            ['sha512/256', 'other server seed', 'client seed', '1', 90, 100, 93.858515686776],
            ['sha512/256', 'server seed', 'other client seed', '1', 90, 100, 94.108397702925],
            ['sha512/256', 'other server seed', 'other client seed', '1', 90, 100, 98.912321670786],
            ['sha512/256', 'server seed', 'client seed', '1', 0, 100, 75.091900608898],
            ['sha512', 'server seed', 'client seed', '1', 0, 100, 97.333312821084],
            ['sha512', 'server seed', 'client seed', '1', 0, 100, 97.333312821084],
            ['sha256', 'server seed', 'client seed', 'nonce', 23.75, 44, 39.396029461939],
            ['sha256', 'server seed', 'client seed', 'new nonce', 23.75, 44, 26.524963826066],
        ];
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itAcceptsAValidHmacAlgorithm()
    {
        foreach (hash_hmac_algos() as $hash_hmac_algo) {
            $this->provablyFair->setAlgorithm($hash_hmac_algo);
            $this->assertEquals($hash_hmac_algo, $this->provablyFair->getAlgorithm());
        }
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itThrowsInvalidAlgorithmExceptionCorrectly()
    {
        $this->expectException(InvalidAlgorithmException::class);

        $this->provablyFair->setAlgorithm('invalid hmac algorithm');
    }

    /**
     * @test
     * @throws InvalidRangeException
     */
    public function itThrowsInvalidRangeExceptionIfMinIsGreaterThanMax()
    {
        $this->expectException(InvalidRangeException::class);

        $this->provablyFair->setRange(50, 22);
    }

    /**
     * @test
     * @throws InvalidRangeException
     */
    public function itThrowsInvalidRangeExceptionIfMinIsEqualToMax()
    {
        $this->expectException(InvalidRangeException::class);

        $this->provablyFair->setRange(50, 50);
    }

    /**
     * @test
     */
    public function itDefaultsToAlgorithmSha512256MinZeroAndMaxOneHundred()
    {
        $serverSeed = 'server seed';
        $clientSeed = 'server seed';
        $nonce = 'nonce';

        $this->provablyFair->setServerSeed($serverSeed);
        $this->provablyFair->setClientSeed($clientSeed);
        $this->provablyFair->setNonce($nonce);

        $this->assertEquals('sha512/256', $this->provablyFair->getAlgorithm());
        $this->assertEquals(0, $this->provablyFair->getMin());
        $this->assertEquals(100, $this->provablyFair->getMax());
    }

    /**
     * @test
     * @dataProvider dataProvider
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
    public function itGeneratesACorrectResult(
        string $algorithm,
        string $serverSeed,
        string $clientSeed,
        string $nonce,
        float $min,
        float $max,
        float $result
    ) {
        $this->provablyFair->setAlgorithm($algorithm);
        $this->provablyFair->setClientSeed($clientSeed);
        $this->provablyFair->setServerSeed($serverSeed);
        $this->provablyFair->setNonce($nonce);
        $this->provablyFair->setRange($min, $max);

        $this->assertEquals(0, bccomp("$result", "{$this->provablyFair->roll()}", 6));
    }

    /**
     * @test
     * @dataProvider dataProvider
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
        $this->provablyFair->setAlgorithm($algorithm);
        $this->provablyFair->setClientSeed($clientSeed);
        $this->provablyFair->setServerSeed($serverSeed);
        $this->provablyFair->setNonce($nonce);
        $this->provablyFair->setRange($min, $max);

        $this->assertTrue($this->provablyFair->verify($result));
        $this->assertFalse($this->provablyFair->verify(-1));
    }
}
