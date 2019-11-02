<?php

namespace PhpProvablyFair\Traits;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;

trait ProvablyFairTrait
{
    /** @var string */
    private $algorithm;
    /** @var string */
    private $serverSeed;
    /** @var string */
    private $clientSeed;
    /** @var string */
    private $nonce;
    /** @var float */
    private $min;
    /** @var float */
    private $max;

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     * @throws InvalidAlgorithmException
     */
    public function setAlgorithm(string $algorithm): void
    {
        if (is_null($algorithm) || !in_array($algorithm, hash_hmac_algos())) {
            throw new InvalidAlgorithmException($algorithm);
        }
        $this->algorithm = $algorithm;
    }

    /**
     * @return string
     */
    public function getServerSeed(): string
    {
        return $this->serverSeed;
    }

    /**
     * @param string $serverSeed
     */
    public function setServerSeed(string $serverSeed): void
    {
        $this->serverSeed = $serverSeed;
    }

    /**
     * @return string
     */
    public function getClientSeed(): string
    {
        return $this->clientSeed;
    }

    /**
     * @param string $clientSeed
     */
    public function setClientSeed(string $clientSeed): void
    {
        $this->clientSeed = $clientSeed;
    }

    /**
     * @return string
     */
    public function getNonce(): string
    {
        return $this->nonce;
    }

    /**
     * @param string $nonce
     */
    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
    }

    /**
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * @param float $min
     */
    public function setMin(float $min): void
    {
        $this->min = $min;
    }

    /**
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * @param float $max
     */
    public function setMax(float $max): void
    {
        $this->max = $max;
    }
}
