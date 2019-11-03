<?php

namespace PhpProvablyFair\Interfaces;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;
use PhpProvablyFair\Exceptions\InvalidRangeException;

interface ProvablyFairInterface
{
    /** @var int */
    public const BYTES = 6;
    /** @var float */
    public const DEFAULT_MIN = 0;
    /** @var float */
    public const DEFAULT_MAX = 100;
    /** @var string */
    public const DEFAULT_ALGORITHM = 'sha512/256';

    /**
     * @return string
     */
    public function getAlgorithm(): string;

    /**
     * @param string $algorithm
     * @throws InvalidAlgorithmException
     */
    public function setAlgorithm(string $algorithm): void;

    /**
     * @return string
     */
    public function getServerSeed(): string;

    /**
     * @param string $serverSeed
     */
    public function setServerSeed(string $serverSeed): void;

    /**
     * @return string
     */
    public function getClientSeed(): string;

    /**
     * @param string $clientSeed
     */
    public function setClientSeed(string $clientSeed): void;

    /**
     * @return string
     */
    public function getNonce(): string;

    /**
     * @param string $nonce
     */
    public function setNonce(string $nonce): void;

    /**
     * @return float
     */
    public function getMin(): float;

    /**
     * @return float
     */
    public function getMax(): float;

    /**
     * @param float $min
     * @param float $max
     * @throws InvalidRangeException
     */
    public function setRange(float $min, float $max): void;

    /**
     * Generate a value for a provably fair game
     * @return float
     */
    public function generate(): float;

    /**
     * Verify a value for a provably fair game
     * @param float $result
     * @return bool
     */
    public function verify(float $result): bool;
}
