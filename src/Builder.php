<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Interfaces\BuilderInterface;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;

class Builder implements BuilderInterface
{
    /** @var ProvablyFairInterface */
    protected $provablyFair;

    /**
     * Builder constructor.
     */
    private function __construct()
    {
        $this->provablyFair = new ProvablyFair();
    }

    /**
     * Return a new instance of itself
     * @return Builder
     */
    public static function make(): BuilderInterface
    {
        return new Builder();
    }

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
     * @param float $max
     * @return BuilderInterface
     * @throws Exceptions\InvalidRangeException
     */
    public function range(float $min, float $max): BuilderInterface
    {
        $this->provablyFair->setRange($min, $max);
        return $this;
    }

    /**
     * @return ProvablyFairInterface
     */
    public function build(): ProvablyFairInterface
    {
        return $this->provablyFair;
    }
}
