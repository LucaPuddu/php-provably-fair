<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Builder;
use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;
use PhpProvablyFair\Interfaces\BuilderInterface;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

class BuilderTest extends TestCase
{
    /** @var BuilderInterface */
    private $builder;
    /** @var ProvablyFairInterface */
    private $provablyFair;

    /**
     * @throws ReflectionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = $this->getMockForAbstractClass(Builder::class);

        $this->provablyFair = $this->getMockBuilder(ProvablyFairInterface::class)->getMock();
        $reflection = new ReflectionClass($this->builder);
        $reflection_property = $reflection->getProperty('provablyFair');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($this->builder, $this->provablyFair);
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function returnSelfInSetters()
    {
        $this->assertEquals($this->builder, $this->builder->algorithm('sha512'));
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     * @throws InvalidRangeException
     */
    public function itCallsTheProvablyFairSetters()
    {
        $this->provablyFair->expects($this->once())->method('setAlgorithm')->with('sha256');
        $this->provablyFair->expects($this->once())->method('setServerSeed')->with('server seed');
        $this->provablyFair->expects($this->once())->method('setClientSeed')->with('client seed');
        $this->provablyFair->expects($this->once())->method('setNonce')->with('nonce');
        $this->provablyFair->expects($this->once())->method('setRange')->with(2, 34);

        $this->builder->algorithm('sha256');
        $this->builder->serverSeed('server seed');
        $this->builder->clientSeed('client seed');
        $this->builder->nonce('nonce');
        $this->builder->range(2, 34);
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itDoesntCatchInvalidAlgorithmException()
    {
        $this->expectException(InvalidAlgorithmException::class);

        $this->provablyFair->method('setAlgorithm')
            ->willThrowException(new InvalidAlgorithmException('error'));

        $this->builder->algorithm('invalid HMAC algorithm');
    }

    /**
     * @test
     * @throws InvalidAlgorithmException
     */
    public function itDoesntCatchInvalidRangeException()
    {
        $this->expectException(InvalidAlgorithmException::class);

        $this->provablyFair->method('setAlgorithm')
            ->willThrowException(new InvalidAlgorithmException('error'));

        $this->builder->algorithm('invalid HMAC algorithm');
    }
}
