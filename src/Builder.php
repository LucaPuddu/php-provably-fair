<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Interfaces\BuilderInterface;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;

abstract class Builder implements BuilderInterface
{
    /** @var ProvablyFairInterface */
    protected $provablyFair;

    /**
     * @param string $algorithm
     * @return BuilderInterface
     * @throws InvalidAlgorithmException
     */
    public function algorithm(string $algorithm): BuilderInterface
    {
        $this->provablyFair->setAlgorithm($algorithm);
        return $this;
    }

    /**
     * @param string $serverSeed
     * @return BuilderInterface
     */
    public function serverSeed(string $serverSeed): BuilderInterface
    {
        $this->provablyFair->setServerSeed($serverSeed);
        return $this;
    }

    /**
     * @param string $clientSeed
     * @return BuilderInterface
     */
    public function clientSeed(string $clientSeed): BuilderInterface
    {
        $this->provablyFair->setClientSeed($clientSeed);
        return $this;
    }

    /**
     * @param string $nonce
     * @return BuilderInterface
     */
    public function nonce(string $nonce): BuilderInterface
    {
        $this->provablyFair->setNonce($nonce);
        return $this;
    }

    /**
     * @param float $min
     * @return BuilderInterface
     */
    public function min(float $min): BuilderInterface
    {
        $this->provablyFair->setMin($min);
        return $this;
    }

    /**
     * @param float $max
     * @return BuilderInterface
     */
    public function max(float $max): BuilderInterface
    {
        $this->provablyFair->setMax($max);
        return $this;
    }
}
