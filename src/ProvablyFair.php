<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;

class ProvablyFair implements ProvablyFairInterface
{
    /** @var int */
    public const BYTES = 6;
    /** @var float */
    public const DEFAULT_MIN = 0;
    /** @var float */
    public const DEFAULT_MAX = 100;
    /** @var string */
    public const DEFAULT_ALGORITHM = 'sha512/256';

    /** @var string */
    protected $algorithm;
    /** @var string */
    protected $serverSeed;
    /** @var string */
    protected $clientSeed;
    /** @var string */
    protected $nonce;
    /** @var float */
    protected $min;
    /** @var float */
    protected $max;

    public function __construct()
    {
        $this->algorithm = self::DEFAULT_ALGORITHM;
        $this->min = self::DEFAULT_MIN;
        $this->max = self::DEFAULT_MAX;
    }

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

    /**
     * Generate a value for a provably fair game
     */
    public function generate(): float
    {
        $hash = hash_hmac($this->algorithm, "{$this->clientSeed}-{$this->nonce}", $this->serverSeed);
        $hash = substr($hash, 6, self::BYTES);
        $toDec = hexdec($hash);
        $normalizeToMax = $toDec / (16 ** self::BYTES - 1);
        $scaleToRange = $normalizeToMax * ($this->max - $this->min);
        $shiftToMin = $scaleToRange + $this->min;

        return $shiftToMin;
    }

    /**
     * Verify a value for a provably fair game
     * @param float $result
     * @return bool
     */
    public function verify(float $result): bool
    {
        return bccomp("{$result}", "{$this->generate()}", 6) == 0;
    }
}
