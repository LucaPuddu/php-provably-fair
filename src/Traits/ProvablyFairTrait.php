<?php

namespace PhpProvablyFair\Traits;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;

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
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * @return float[]
     */
    public function getRange(): array
    {
        return [$this->min, $this->max];
    }

    /**
     * @param float $min
     * @param float $max
     * @throws InvalidRangeException
     */
    public function setRange(float $min, float $max): void
    {
        if ($min >= $max) {
            throw new InvalidRangeException($min, $max);
        }

        $this->min = $min;
        $this->max = $max;
    }
}
